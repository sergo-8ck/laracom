<?php

namespace App\Blog\Sections\Repositories;

use App\Blog\Section\Repositories\Interfaces\SectionRepositoryInterface;
use Jsdecena\Baserepo\BaseRepository;
use App\Blog\Sections\Section;
use App\Blog\Sections\Exceptions\SectionInvalidArgumentException;
use App\Blog\Sections\Exceptions\CategoryNotFoundException;
use App\Blog\Articles\Article;
use App\Blog\Articles\Transformations\ArticleTransformable;
use App\Shop\Tools\UploadableTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class SectionRepository extends BaseRepository implements SectionRepositoryInterface
{
    use UploadableTrait, ArticleTransformable;

    /**
     * CategoryRepository constructor.
     *
     * @param Section $category
     */
    public function __construct(Section $category)
    {
        parent::__construct($category);
        $this->model = $category;
    }

    /**
     * List all the categories
     *
     * @param string $order
     * @param string $sort
     * @param array $except
     * @return \Illuminate\Support\Collection
     */
    public function listCategories(string $order = 'id', string $sort = 'desc', $except = []) : Collection
    {
        return $this->model->orderBy($order, $sort)->get()->except($except);
    }

    /**
     * List all root categories
     * 
     * @param  string $order 
     * @param  string $sort  
     * @param  array  $except
     * @return \Illuminate\Support\Collection  
     */
    public function rootCategories(string $order = 'id', string $sort = 'desc', $except = []) : Collection
    {
        return $this->model->whereIsRoot()
                        ->orderBy($order, $sort)
                        ->get()
                        ->except($except);
    }

    /**
     * Create the category
     *
     * @param array $params
     *
     * @return Section
     * @throws SectionInvalidArgumentException
     * @throws CategoryNotFoundException
     */
    public function createCategory(array $params): Section
    {
        try {

            $collection = collect($params);
            if (isset($params['name'])) {
                $slug = str_slug($params['name']);
            }

            if (isset($params['cover']) && ($params['cover'] instanceof UploadedFile)) {
                $cover = $this->uploadOne($params['cover'], 'categories');
            }

            $merge = $collection->merge(compact('slug', 'cover'));

            $category = new Section($merge->all());

            if (isset($params['parent'])) {
                $parent = $this->findCategoryById($params['parent']);
                $category->parent()->associate($parent);
            }

            $category->save();
            return $category;
        } catch (QueryException $e) {
            throw new SectionInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * Update the category
     *
     * @param array $params
     *
     * @return Section
     * @throws CategoryNotFoundException
     */
    public function updateCategory(array $params): Section
    {
        $category = $this->findCategoryById($this->model->id);
        $collection = collect($params)->except('_token');
        $slug = str_slug($collection->get('name'));

        if (isset($params['cover']) && ($params['cover'] instanceof UploadedFile)) {
            $cover = $this->uploadOne($params['cover'], 'categories');
        }

        $merge = $collection->merge(compact('slug', 'cover'));
        if (isset($params['parent'])) {
            $parent = $this->findCategoryById($params['parent']);
            $category->parent()->associate($parent);
        }

        $category->update($merge->all());
        return $category;
    }

    /**
     * @param int $id
     *
     * @return Section
     * @throws CategoryNotFoundException
     */
    public function findCategoryById(int $id) : Section
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException($e->getMessage());
        }
    }

    /**
     * Delete a category
     *
     * @return bool
     * @throws \Exception
     */
    public function deleteCategory() : bool
    {
        return $this->model->delete();
    }

    /**
     * Associate a product in a category
     *
     * @param Article $product
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function associateProduct(Article $product)
    {
        return $this->model->products()->save($product);
    }

    /**
     * Return all the products associated with the category
     *
     * @return mixed
     */
    public function findProducts() : Collection
    {
        return $this->model->products;
    }

    /**
     * @param array $params
     */
    public function syncProducts(array $params)
    {
        $this->model->products()->sync($params);
    }


    /**
     * Detach the association of the product
     *
     */
    public function detachProducts()
    {
        $this->model->products()->detach();
    }

    /**
     * @param $file
     * @param null $disk
     * @return bool
     */
    public function deleteFile(array $file, $disk = null) : bool
    {
        return $this->update(['cover' => null], $file['category']);
    }

    /**
     * Return the category by using the slug as the parameter
     *
     * @param array $slug
     *
     * @return Section
     * @throws CategoryNotFoundException
     */
    public function findCategoryBySlug(array $slug) : Section
    {
        try {
            return $this->findOneByOrFail($slug);
        } catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException($e);
        }
    }

    /**
     * @return mixed
     */
    public function findParentCategory()
    {
        return $this->model->parent;
    }

    /**
     * @return mixed
     */
    public function findChildren()
    {
        return $this->model->children;
    }
}
