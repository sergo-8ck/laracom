<?php

namespace App\Http\Controllers\Frontend;

use App\Blog\Articles\Article;
use App\Blog\Articles\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Blog\Articles\Transformations\ArticleTransformable;
use App\Shop\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class HomeController
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
    public function index()
    {
        $article = $this->articleRepo->findArticleBySlug([
            'slug' => 'glavnaya'
        ]);

        $uvedomlenie = $this->articleRepo->findArticleBySlug([
            'slug' => 'uvedomlenie'
        ]);

        return view('frontend.pages.index', compact('article', 'uvedomlenie'));
    }
}
