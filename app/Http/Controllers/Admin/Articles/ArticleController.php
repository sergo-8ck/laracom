<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Blog\Sections\Repositories\Interfaces\SectionRepositoryInterface;
use App\Shop\Attributes\Repositories\AttributeRepositoryInterface;
use App\Shop\AttributeValues\Repositories\AttributeValueRepositoryInterface;
use App\Shop\Brands\Repositories\BrandRepositoryInterface;
use App\Blog\ArticleAttributes\ArticleAttribute;
use App\Blog\Articles\Article;
use App\Blog\Articles\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Blog\Articles\Repositories\ArticleRepository;
use App\Blog\Articles\Requests\CreateArticleRequest;
use App\Blog\Articles\Requests\UpdateArticleRequest;
use App\Http\Controllers\Controller;
use App\Blog\Articles\Transformations\ArticleTransformable;
use App\Shop\Tools\UploadableTrait;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    use ArticleTransformable, UploadableTrait;

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepo;

    /**
     * @var SectionRepositoryInterface
     */
    private $sectionRepo;

    /**
     * @var AttributeRepositoryInterface
     */
    private $attributeRepo;

    /**
     * @var AttributeValueRepositoryInterface
     */
    private $attributeValueRepository;

    /**
     * @var ArticleAttribute
     */
    private $articleAttribute;

    /**
     * @var BrandRepositoryInterface
     */
    private $brandRepo;

    /**
     * ArticleController constructor.
     *
     * @param ArticleRepositoryInterface $articleRepository
     * @param SectionRepositoryInterface $sectionRepository
     * @param AttributeRepositoryInterface $attributeRepository
     * @param AttributeValueRepositoryInterface $attributeValueRepository
     * @param ArticleAttribute $articleAttribute
     * @param BrandRepositoryInterface $brandRepository
     */
    public function __construct(
        ArticleRepositoryInterface $articleRepository,
        SectionRepositoryInterface $sectionRepository,
        AttributeRepositoryInterface $attributeRepository,
        AttributeValueRepositoryInterface $attributeValueRepository,
        ArticleAttribute $articleAttribute,
        BrandRepositoryInterface $brandRepository
    ) {
        $this->articleRepo = $articleRepository;
        $this->sectionRepo = $sectionRepository;
        $this->attributeRepo = $attributeRepository;
        $this->attributeValueRepository = $attributeValueRepository;
        $this->articleAttribute = $articleAttribute;
        $this->brandRepo = $brandRepository;

        $this->middleware(['permission:create-article, guard:employee'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:update-article, guard:employee'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-article, guard:employee'], ['only' => ['destroy']]);
        $this->middleware(['permission:view-article, guard:employee'], ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->articleRepo->listArticles('id');

        if (request()->has('q') && request()->input('q') != '') {
            $list = $this->articleRepo->searchArticle(request()->input('q'));
        }

        $articles = $list->map(function (Article $item) {
            return $this->transformArticle($item);
        })->all();

        return view('admin.articles.list', [
            'articles' => $this->articleRepo->paginateArrayResults($articles, 25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = $this->sectionRepo->listSections('name', 'asc');

        return view('admin.articles.create', [
            'sections' => $sections,
            'brands' => $this->brandRepo->listBrands(['*'], 'name', 'asc'),
            'default_weight' => env('SHOP_WEIGHT'),
            'weight_units' => Article::MASS_UNIT,
            'article' => new Article
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateArticleRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticleRequest $request)
    {
        $data = $request->except('_token', '_method');
        $data['slug'] = str_slug($request->input('name'));

        if ($request->hasFile('cover') && $request->file('cover') instanceof UploadedFile) {
            $data['cover'] = $this->articleRepo->saveCoverImage($request->file('cover'));
        }
        if ($request->hasFile('background') && $request->file('background') instanceof UploadedFile) {
            $data['background'] = $this->articleRepo->saveCoverImage($request->file('background'));
        }

        $article = $this->articleRepo->createArticle($data);

        $articleRepo = new ArticleRepository($article);

        if ($request->hasFile('image')) {
            $articleRepo->saveArticleImages(collect($request->file('image')));
        }

        if ($request->has('sections')) {
            $articleRepo->syncSections($request->input('sections'));
        } else {
            $articleRepo->detachSections();
        }

        return redirect()->route('admin.articles.edit', $article->id)->with('message', 'Create successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $article = $this->articleRepo->findArticleById($id);
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $article = $this->articleRepo->findArticleById($id);

        if (request()->has('delete') && request()->has('pa')) {
            request()->session()->flash('message', 'Delete successful');
            return redirect()->route('admin.articles.edit', [$article->id, 'combination' => 1]);
        }

        $sections = $this->sectionRepo->listSections('name', 'asc')->toTree();
	
        return view('admin.articles.edit', [
            'article' => $article,
            'images' => $article->images()->get(['src']),
            'sections' => $sections,
            'selectedIds' => $article->sections()->pluck('section_id')->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateArticleRequest $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \App\Blog\Articles\Exceptions\ArticleUpdateErrorException
     */
    public function update(UpdateArticleRequest $request, int $id)
    {
        $article = $this->articleRepo->findArticleById($id);
        $articleRepo = new ArticleRepository($article);

        $data = $request->except(
            'sections',
            '_token',
            '_method',
            'default',
            'image',
            'attributeValue',
            'combination'
        );

        if ($request->hasFile('cover')) {
            $data['cover'] = $articleRepo->saveCoverImage($request->file('cover'));
        }

        if ($request->hasFile('background')) {
            $data['background'] = $articleRepo->saveCoverImage($request->file('background'));
        }

        if ($request->hasFile('image')) {
            $articleRepo->saveArticleImages(collect($request->file('image')));
        }

        if ($request->has('sections')) {
            $articleRepo->syncSections($request->input('sections'));
        } else {
            $articleRepo->detachSections();
        }

        $articleRepo->updateArticle($data);

        return redirect()->route('admin.articles.edit', $id)
            ->with('message', 'Update successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $article = $this->articleRepo->findArticleById($id);
        $article->sections()->sync([]);

        $articleRepo = new ArticleRepository($article);
        $articleRepo->removeArticle();

        return redirect()->route('admin.articles.index')->with('message', 'Delete successful');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeImage(Request $request)
    {
        $this->articleRepo->deleteFile($request->only('article', 'image'), 'uploads');
        return redirect()->back()->with('message', 'Image delete successful');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeThumbnail(Request $request)
    {
        $this->articleRepo->deleteThumb($request->input('src'));
        return redirect()->back()->with('message', 'Image delete successful');
    }
}
