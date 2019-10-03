<?php

namespace App\Blog\Reviews\Repositories\Interfaces;

use Jsdecena\Baserepo\BaseRepositoryInterface;
use App\Blog\Reviews\Review;
use App\Blog\Articles\Article;
use Illuminate\Support\Collection;

interface ReviewRepositoryInterface extends BaseRepositoryInterface
{
    public function listReview(string $order = 'id', string $sort = 'desc', $except = []) : Collection;

    public function createReview(array $params) : Review;

    public function updateReview(array $params) : Review;

    public function findReviewById(int $id) : Review;

    public function deleteReview() : bool;

    public function associateArticle(Article $article);

    public function findArticles() : Collection;

    public function syncArticles(array $params);

    public function detachArticles();

    public function deleteFile(array $file, $disk = null) : bool;

    public function findReviewBySlug(array $slug) : Review;

    public function rootReviews(string $string, string $string1);
}
