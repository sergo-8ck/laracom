<?php

namespace App\Blog\Sections\Repositories\Interfaces;

use Jsdecena\Baserepo\BaseRepositoryInterface;
use App\Blog\Sections\Section;
use App\Blog\Articles\Article;
use Illuminate\Support\Collection;

interface SectionRepositoryInterface extends BaseRepositoryInterface
{
    public function listCategories(string $order = 'id', string $sort = 'desc', $except = []) : Collection;

    public function createCategory(array $params) : Section;

    public function updateCategory(array $params) : Section;

    public function findCategoryById(int $id) : Section;

    public function deleteCategory() : bool;

    public function associateProduct(Article $product);

    public function findProducts() : Collection;

    public function syncProducts(array $params);

    public function detachProducts();

    public function deleteFile(array $file, $disk = null) : bool;

    public function findCategoryBySlug(array $slug) : Section;

    public function rootCategories(string $string, string $string1);
}
