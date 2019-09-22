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
    public function listArticles(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Collection;

    public function createArticle(array $data) : Article;

    public function updateArticle(array $data) : bool;

    public function findArticleById(int $id) : Article;

    public function deleteArticle(Article $article) : bool;

    public function removeArticle() : bool;

    public function detachSections();

    public function getSections() : Collection;

    public function syncSections(array $params);

    public function deleteFile(array $file, $disk = null) : bool;

    public function deleteThumb(string $src) : bool;

    public function findArticleBySlug(array $slug) : Article;

    public function searchArticle(string $text) : Collection;

    public function findArticleImages() : Collection;

    public function saveCoverImage(UploadedFile $file) : string;

    public function saveArticleImages(Collection $collection);
}
