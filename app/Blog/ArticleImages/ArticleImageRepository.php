<?php

namespace App\Blog\ArticleImages;

use Jsdecena\Baserepo\BaseRepository;
use App\Blog\Articles\Article;

class ArticleImageRepository extends BaseRepository
{
    /**
     * ProductImageRepository constructor.
     *
     * @param ArticleImage $productImage
     */
    public function __construct(ArticleImage $productImage)
    {
        parent::__construct($productImage);
        $this->model = $productImage;
    }

    /**
     * @return mixed
     */
    public function findProduct() : Article
    {
        return $this->model->product;
    }
}
