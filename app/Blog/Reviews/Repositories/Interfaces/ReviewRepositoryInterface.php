<?php

namespace App\Blog\Reviews\Repositories\Interfaces;

use App\Shop\Customers\Customer;
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

    public function associateCustomer(Customer $customer);

    public function deleteFile(array $file, $disk = null) : bool;

    public function rootReviews(string $string, string $string1);
}
