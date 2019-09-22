<?php

namespace App\Blog\Articles\Repositories;

use App\Shop\AttributeValues\AttributeValue;
use App\Blog\Articles\Exceptions\ArticleCreateErrorException;
use App\Blog\Articles\Exceptions\ArticleUpdateErrorException;
use App\Shop\Tools\UploadableTrait;
use Jsdecena\Baserepo\BaseRepository;
use App\Shop\Brands\Brand;
use App\Blog\ArticleAttributes\ArticleAttribute;
use App\Blog\ArticleImages\ArticleImage;
use App\Blog\Articles\Exceptions\ArticleNotFoundException;
use App\Blog\Articles\Article;
use App\Blog\Articles\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Blog\Articles\Transformations\ArticleTransformable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{
    use ArticleTransformable, UploadableTrait;

    /**
     * ArticleRepository constructor.
     *
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        parent::__construct($article);
        $this->model = $article;
    }

    /**
     * List all the article
     *
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return Collection
     */
    public function listArticles(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Collection
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * Create the article
     *
     * @param array $data
     *
     * @return Article
     * @throws ArticleCreateErrorException
     */
    public function createArticle(array $data): Article
    {
        try {
            return $this->create($data);
        } catch (QueryException $e) {
            throw new ArticleCreateErrorException($e);
        }
    }

    /**
     * Update the article
     *
     * @param array $data
     *
     * @return bool
     * @throws ArticleUpdateErrorException
     */
    public function updateArticle(array $data) : bool
    {
        $filtered = collect($data)->except('image')->all();

        try {
            return $this->model->where('id', $this->model->id)->update($filtered);
        } catch (QueryException $e) {
            throw new ArticleUpdateErrorException($e);
        }
    }

    /**
     * Find the article by ID
     *
     * @param int $id
     *
     * @return Article
     * @throws ArticleNotFoundException
     */
    public function findArticleById(int $id): Article
    {
        try {
            return $this->transformArticle($this->findOneOrFail($id));
        } catch (ModelNotFoundException $e) {
            throw new ArticleNotFoundException($e);
        }
    }

    /**
     * Delete the article
     *
     * @param Article $article
     *
     * @return bool
     * @throws \Exception
     * @deprecated
     * @use removeArticle
     */
    public function deleteArticle(Article $article) : bool
    {
        $article->images()->delete();
        return $article->delete();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function removeArticle() : bool
    {
        return $this->model->where('id', $this->model->id)->delete();
    }

    /**
     * Detach the sections
     */
    public function detachSections()
    {
        $this->model->sections()->detach();
    }

    /**
     * Return the sections which the article is associated with
     *
     * @return Collection
     */
    public function getSections() : Collection
    {
        return $this->model->sections()->get();
    }

    /**
     * Sync the sections
     *
     * @param array $params
     */
    public function syncSections(array $params)
    {
        $this->model->sections()->sync($params);
    }

    /**
     * @param $file
     * @param null $disk
     * @return bool
     */
    public function deleteFile(array $file, $disk = null) : bool
    {
        return $this->update(['cover' => null], $file['article']);
    }

    /**
     * @param string $src
     * @return bool
     */
    public function deleteThumb(string $src) : bool
    {
        return DB::table('article_images')->where('src', $src)->delete();
    }

    /**
     * Get the article via slug
     *
     * @param array $slug
     *
     * @return Article
     * @throws ArticleNotFoundException
     */
    public function findArticleBySlug(array $slug): Article
    {
        try {
            return $this->findOneByOrFail($slug);
        } catch (ModelNotFoundException $e) {
            throw new ArticleNotFoundException($e);
        }
    }

    /**
     * @param string $text
     * @return mixed
     */
    public function searchArticle(string $text) : Collection
    {
        if (!empty($text)) {
            return $this->model->searchArticle($text);
        } else {
            return $this->listArticles();
        }
    }

    /**
     * @return mixed
     */
    public function findArticleImages() : Collection
    {
        return $this->model->images()->get();
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function saveCoverImage(UploadedFile $file) : string
    {
        return $file->store('article', ['disk' => 'public']);
    }

    /**
     * @param Collection $collection
     *
     * @return void
     */
    public function saveArticleImages(Collection $collection)
    {
        $collection->each(function (UploadedFile $file) {
            $filename = $this->storeFile($file);
            $articleImage = new ArticleImage([
                'article_id' => $this->model->id,
                'src' => $filename
            ]);
            $this->model->images()->save($articleImage);
        });
    }

    /**
     * Associate the article attribute to the article
     *
     * @param ArticleAttribute $articleAttribute
     *
     * @return ArticleAttribute
     */
    public function saveArticleAttributes(ArticleAttribute $articleAttribute): ArticleAttribute
    {
        $this->model->attributes()->save($articleAttribute);
        return $articleAttribute;
    }

    /**
     * List all the article attributes associated with the article
     *
     * @return Collection
     */
    public function listArticleAttributes() : Collection
    {
        return $this->model->attributes()->get();
    }

    /**
     * Delete the attribute from the article
     *
     * @param ArticleAttribute $articleAttribute
     *
     * @return bool|null
     * @throws \Exception
     */
    public function removeArticleAttribute(ArticleAttribute $articleAttribute) : ?bool
    {
        return $articleAttribute->delete();
    }

    /**
     * @param ArticleAttribute $articleAttribute
     * @param AttributeValue   ...$attributeValues
     *
     * @return Collection
     */
    public function saveCombination(ArticleAttribute $articleAttribute, AttributeValue ...$attributeValues) : Collection
    {
        return collect($attributeValues)->each(function (AttributeValue $value) use ($articleAttribute) {
            return $articleAttribute->attributesValues()->save($value);
        });
    }

    /**
     * @return Collection
     */
    public function listCombinations() : Collection
    {
        return $this->model->attributes()->map(function (ArticleAttribute $articleAttribute) {
            return $articleAttribute->attributesValues;
        });
    }

    /**
     * @param ArticleAttribute $articleAttribute
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findArticleCombination(ArticleAttribute $articleAttribute)
    {
        $values = $articleAttribute->attributesValues()->get();

        return $values->map(function (AttributeValue $attributeValue) {
            return $attributeValue;
        })->keyBy(function (AttributeValue $item) {
            return strtolower($item->attribute->name);
        })->transform(function (AttributeValue $value) {
            return $value->value;
        });
    }

    /**
     * @param Brand $brand
     */
    public function saveBrand(Brand $brand)
    {
        $this->model->brand()->associate($brand);
    }

    /**
     * @return Brand
     */
    public function findBrand()
    {
        return $this->model->brand;
    }
}
