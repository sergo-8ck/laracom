<?php

namespace App\Blog\Sections\Repositories;

use App\Blog\Sections\Repositories\Interfaces\SectionRepositoryInterface;
use Jsdecena\Baserepo\BaseRepository;
use App\Blog\Sections\Section;
use App\Blog\Sections\Exceptions\SectionInvalidArgumentException;
use App\Blog\Sections\Exceptions\SectionNotFoundException;
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
     * SectionRepository constructor.
     *
     * @param Section $section
     */
    public function __construct(Section $section)
    {
        parent::__construct($section);
        $this->model = $section;
    }

    /**
     * List all the sections
     *
     * @param string $order
     * @param string $sort
     * @param array $except
     * @return \Illuminate\Support\Collection
     */
    public function listSections(string $order = 'id', string $sort = 'desc', $except = []) : Collection
    {
        return $this->model->orderBy($order, $sort)->get()->except($except);
    }

    /**
     * List all root sections
     * 
     * @param  string $order 
     * @param  string $sort  
     * @param  array  $except
     * @return \Illuminate\Support\Collection  
     */
    public function rootSections(string $order = 'id', string $sort = 'desc', $except = []) : Collection
    {
        return $this->model->whereIsRoot()
                        ->orderBy($order, $sort)
                        ->get()
                        ->except($except);
    }

    /**
     * Create the section
     *
     * @param array $params
     *
     * @return Section
     * @throws SectionInvalidArgumentException
     * @throws SectionNotFoundException
     */
    public function createSection(array $params): Section
    {
        try {

            $collection = collect($params);
            if (isset($params['name'])) {
                $slug = str_slug($params['name']);
            }

            if (isset($params['cover']) && ($params['cover'] instanceof UploadedFile)) {
                $cover = $this->uploadOne($params['cover'], 'sections');
            }

            if (isset($params['background']) && ($params['background'] instanceof UploadedFile)) {
                $background = $this->uploadOne($params['background'], 'sections');
            }

            $merge = $collection->merge(compact('slug', 'cover', 'background'));

            $section = new Section($merge->all());

            if (isset($params['parent'])) {
                $parent = $this->findSectionById($params['parent']);
                $section->parent()->associate($parent);
            }

            $section->save();
            return $section;
        } catch (QueryException $e) {
            throw new SectionInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * Update the section
     *
     * @param array $params
     *
     * @return Section
     * @throws SectionNotFoundException
     */
    public function updateSection(array $params): Section
    {
        $section = $this->findSectionById($this->model->id);
        $collection = collect($params)->except('_token');
        $slug = str_slug($collection->get('name'));

        if (isset($params['cover']) && ($params['cover'] instanceof UploadedFile)) {
            $cover = $this->uploadOne($params['cover'], 'sections');
        }

        if (isset($params['background']) && ($params['background'] instanceof UploadedFile)) {
            $background = $this->uploadOne($params['background'], 'sections');
        }

        $merge = $collection->merge(compact('slug', 'cover', 'background'));

        if (isset($params['parent'])) {
            $parent = $this->findSectionById($params['parent']);
            $section->parent()->associate($parent);
        }

        $section->update($merge->all());
        return $section;
    }

    /**
     * @param int $id
     *
     * @return Section
     * @throws SectionNotFoundException
     */
    public function findSectionById(int $id) : Section
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new SectionNotFoundException($e->getMessage());
        }
    }

    /**
     * Delete a section
     *
     * @return bool
     * @throws \Exception
     */
    public function deleteSection() : bool
    {
        return $this->model->delete();
    }

    /**
     * Associate a article in a section
     *
     * @param Article $article
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function associateArticle(Article $article)
    {
        return $this->model->articles()->save($article);
    }

    /**
     * Return all the articles associated with the section
     *
     * @return mixed
     */
    public function findArticles() : Collection
    {
        return $this->model->articles;
    }

    /**
     * @param array $params
     */
    public function syncArticles(array $params)
    {
        $this->model->articles()->sync($params);
    }


    /**
     * Detach the association of the article
     *
     */
    public function detachArticles()
    {
        $this->model->articles()->detach();
    }

    /**
     * @param $file
     * @param null $disk
     * @return bool
     */
    public function deleteFile(array $file, $disk = null) : bool
    {
        return $this->update([$file['field'] => null], $file['section']);
    }

    /**
     * Return the section by using the slug as the parameter
     *
     * @param array $slug
     *
     * @return Section
     * @throws SectionNotFoundException
     */
    public function findSectionBySlug(array $slug) : Section
    {
        try {
            return $this->findOneByOrFail($slug);
        } catch (ModelNotFoundException $e) {
            throw new SectionNotFoundException($e);
        }
    }

    /**
     * @return mixed
     */
    public function findParentSection()
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
