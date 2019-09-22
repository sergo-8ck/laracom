<?php

namespace App\Blog\ArticleImages;

use Jsdecena\Baserepo\BaseRepository;
use App\Blog\Articles\Article;

class ArticleImageRepository extends BaseRepository
{
    /**
     * ArticleImageRepository constructor.
     *
     * @param ArticleImage $articleImage
     */
    public function __construct(ArticleImage $articleImage)
    {
        parent::__construct($articleImage);
        $this->model = $articleImage;
    }

    /**
     * @return mixed
     */
    public function findArticle() : Article
    {
        return $this->model->article;
    }
}
