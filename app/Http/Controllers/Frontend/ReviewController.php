<?php

namespace App\Http\Controllers\Frontend;

use App\Blog\Articles\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Blog\Reviews\Review;
use App\Http\Controllers\Controller;
use App\Blog\Reviews\Requests\CreateReviewRequest;
use App\Blog\Reviews\Requests\UpdateReviewRequest;
use App\Blog\Reviews\Repositories\ReviewRepository;
use App\Shop\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Blog\Reviews\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Shop\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use App\Shop\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * @var ReviewRepositoryInterface
     */
    private $reviewRepo;

    /**
     * @var ProvinceRepositoryInterface
     */
    private $provinceRepo;

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepo;


    /**
     * @param ReviewRepositoryInterface  $reviewRepository
     * @param ProvinceRepositoryInterface $provinceRepository
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(
        ReviewRepositoryInterface $reviewRepository,
        ProvinceRepositoryInterface $provinceRepository,
        ArticleRepositoryInterface $articleRepository
    ) {
        $this->reviewRepo = $reviewRepository;
        $this->provinceRepo = $provinceRepository;
        $this->articleRepo = $articleRepository;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $article = $this->articleRepo->findArticleBySlug(['slug' => 'otzyivyi']);
        $images = $article->images()->get();
        $section = $article->sections()->first();

        $tpl = 'frontend.articles.otzyivyi';
        $reviews = Review::get()->toTree();

        return view($tpl, compact(
            'article',
            'images',
            'section',
            'combos',
            'reviews'
        ));
    }

    /**
     * @param  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $customer = auth()->user();

        return view('front.customers.reviews.create', [
            'customer' => $customer,
        ]);
    }

    /**
     * @param CreateReviewRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateReviewRequest $request)
    {
        $request['customer_id'] = auth()->user()->id;

        $review = $this->reviewRepo->createReview($request->except('_token', '_method'));

        $reviewRepo = new ReviewRepository($review);

        if ($request->hasFile('image')) {
            $reviewRepo->saveReviewImages(collect($request->file('image')));
        }

        return redirect()->route('otzyivyi.index')
                         ->with('message', 'Review creation successful');
    }

    /**
     * @param $reviewId
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($reviewId)
    {
        $review = $this->reviewRepo->findCustomerReviewById($reviewId, auth()->user());

        $articleRepo = new ReviewRepository($review);
        $articleRepo->deleteReview();

        return redirect()->route('otzyivyi.index')
                         ->with('message', 'Review deleted successful');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeImage(Request $request)
    {
        $this->reviewRepo->deleteFile($request->only('section', 'field'), 'sections');
        request()->session()->flash('message', 'Image delete successful');
        return redirect()->route('admin.review.edit', $request->input('review'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeThumbnail(Request $request)
    {
        $this->reviewRepo->deleteThumb($request->input('src'));
        return redirect()->back()->with('message', 'Image delete successful');
    }
}
