<?php

namespace App\Blog\ArticleAttributes\Repositories;

use Jsdecena\Baserepo\BaseRepositoryInterface;

interface ArticleAttributeRepositoryInterface extends BaseRepositoryInterface
{
    public function findProductAttributeById(int $id);
}
