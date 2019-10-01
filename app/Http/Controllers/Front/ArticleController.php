<?php

namespace App\Http\Controllers\Front;

use App\Blog\Articles\Article;
use App\Blog\Articles\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Blog\Questions\Question;
use App\Http\Controllers\Controller;
use App\Blog\Articles\Transformations\ArticleTransformable;

class ArticleController extends Controller
{
    use ArticleTransformable;

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepo;

    /**
     * ArticleController constructor.
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepo = $articleRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        if (request()->has('q') && request()->input('q') != '') {
            $list = $this->articleRepo->searchArticle(request()->input('q'));
        } else {
            $list = $this->articleRepo->listArticles();
        }

        $articles = $list->where('status', 1)->map(function (Article $item) {
            return $this->transformArticle($item);
        });

        return view('front.articles.article-search', [
            'articles' => $this->articleRepo->paginateArrayResults($articles->all(), 10)
        ]);
    }

    /**
     * Get the article
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $slug)
    {
        $article = $this->articleRepo->findArticleBySlug(['slug' => $slug]);
        $images = $article->images()->get();
        $section = $article->sections()->first();
        $articleAttributes = $article->attributes;

        $tpl = 'frontend.articles.article';
        $questions = [];

        if($slug == 'transportirovka')
            $tpl = 'frontend.articles.transportirovka';
        else if($slug == 'sotrudnichestvo' || $slug == 'kontakty')
            $tpl = 'frontend.articles.contact';
        else if($slug == 'vopros-otvet'){
            $tpl = 'frontend.articles.vopros-otvet';
            $questions = Question::all();
        }


        return view($tpl, compact(
            'article',
            'images',
            'articleAttributes',
            'section',
            'combos',
            'questions'
        ));
    }
}
