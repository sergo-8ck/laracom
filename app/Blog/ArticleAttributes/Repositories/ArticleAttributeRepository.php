<?php

namespace App\Blog\ArticleAttributes\Repositories;

use Jsdecena\Baserepo\BaseRepository;
use App\Blog\ArticleAttributes\Exceptions\ArticleAttributeNotFoundException;
use App\Blog\ArticleAttributes\ArticleAttribute;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ArticleAttributeRepository extends BaseRepository implements ArticleAttributeRepositoryInterface
{
    /**
     * ArticleAttributeRepository constructor.
     *
     * @param ArticleAttribute $articleAttribute
     */
    public function __construct(ArticleAttribute $articleAttribute)
    {
        parent::__construct($articleAttribute);
        $this->model = $articleAttribute;
    }

    /**
     * @param int $id
     *
     * @return mixed
     * @throws ArticleAttributeNotFoundException
     */
    public function findArticleAttributeById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ArticleAttributeNotFoundException($e);
        }
    }
}
