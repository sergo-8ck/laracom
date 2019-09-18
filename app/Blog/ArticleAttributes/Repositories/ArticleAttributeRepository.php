<?php

namespace App\Blog\ArticleAttributes\Repositories;

use Jsdecena\Baserepo\BaseRepository;
use App\Blog\ArticleAttributes\Exceptions\ArticleAttributeNotFoundException;
use App\Blog\ArticleAttributes\ArticleAttribute;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ArticleAttributeRepository extends BaseRepository implements ArticleAttributeRepositoryInterface
{
    /**
     * ProductAttributeRepository constructor.
     *
     * @param ArticleAttribute $productAttribute
     */
    public function __construct(ArticleAttribute $productAttribute)
    {
        parent::__construct($productAttribute);
        $this->model = $productAttribute;
    }

    /**
     * @param int $id
     *
     * @return mixed
     * @throws ArticleAttributeNotFoundException
     */
    public function findProductAttributeById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ArticleAttributeNotFoundException($e);
        }
    }
}
