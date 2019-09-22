<?php

namespace App\Blog\Sections\Repositories\Interfaces;

use Jsdecena\Baserepo\BaseRepositoryInterface;
use App\Blog\Sections\Section;
use App\Blog\Articles\Article;
use Illuminate\Support\Collection;

interface SectionRepositoryInterface extends BaseRepositoryInterface
{
    public function listSections(string $order = 'id', string $sort = 'desc', $except = []) : Collection;

    public function createSection(array $params) : Section;

    public function updateSection(array $params) : Section;

    public function findSectionById(int $id) : Section;

    public function deleteSection() : bool;

    public function associateArticle(Article $article);

    public function findArticles() : Collection;

    public function syncArticles(array $params);

    public function detachArticles();

    public function deleteFile(array $file, $disk = null) : bool;

    public function findSectionBySlug(array $slug) : Section;

    public function rootSections(string $string, string $string1);
}
