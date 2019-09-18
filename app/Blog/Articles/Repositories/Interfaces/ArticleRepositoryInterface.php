<?php

namespace App\Blog\Articles\Repositories\Interfaces;

use App\Shop\AttributeValues\AttributeValue;
use Jsdecena\Baserepo\BaseRepositoryInterface;
use App\Shop\Brands\Brand;
use App\Blog\ArticleAttributes\ArticleAttribute;
use App\Blog\Articles\Article;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

interface ArticleRepositoryInterface extends BaseRepositoryInterface
{
    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Collection;

    public function createProduct(array $data) : Article;

    public function updateProduct(array $data) : bool;

    public function findProductById(int $id) : Article;

    public function deleteProduct(Article $product) : bool;

    public function removeProduct() : bool;

    public function detachCategories();

    public function getCategories() : Collection;

    public function syncCategories(array $params);

    public function deleteFile(array $file, $disk = null) : bool;

    public function deleteThumb(string $src) : bool;

    public function findProductBySlug(array $slug) : Article;

    public function searchProduct(string $text) : Collection;

    public function findProductImages() : Collection;

    public function saveCoverImage(UploadedFile $file) : string;

    public function saveProductImages(Collection $collection);

    public function saveProductAttributes(ArticleAttribute $productAttribute) : ArticleAttribute;

    public function listProductAttributes() : Collection;

    public function removeProductAttribute(ArticleAttribute $productAttribute) : ?bool;

    public function saveCombination(ArticleAttribute $productAttribute, AttributeValue ...$attributeValues) : Collection;

    public function listCombinations() : Collection;

    public function findProductCombination(ArticleAttribute $attribute);

    public function saveBrand(Brand $brand);

    public function findBrand();
}
