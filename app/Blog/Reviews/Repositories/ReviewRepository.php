<?php

namespace App\Blog\Reviews\Repositories;

use App\Blog\Reviews\Repositories\Interfaces\ReviewRepositoryInterface;
use Jsdecena\Baserepo\BaseRepository;
use App\Blog\Reviews\Review;
use App\Blog\Reviews\Exceptions\ReviewInvalidArgumentException;
use App\Blog\Reviews\Exceptions\ReviewNotFoundException;
use App\Blog\Articles\Article;
use App\Blog\Articles\Transformations\ArticleTransformable;
use App\Shop\Tools\UploadableTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    use UploadableTrait, ArticleTransformable;

    /**
     * ReviewRepository constructor.
     *
     * @param Review $Review
     */
    public function __construct(Review $review)
    {
        parent::__construct($review);
        $this->model = $review;
    }

    /**
     * List all the reviews
     *
     * @param string $order
     * @param string $sort
     * @param array $except
     * @return \Illuminate\Support\Collection
     */
    public function listReview(string $order = 'id', string $sort = 'desc', $except = []) : Collection
    {
        return $this->model->orderBy($order, $sort)->get()->except($except);
    }

    /**
     * List all root reviews
     * 
     * @param  string $order 
     * @param  string $sort  
     * @param  array  $except
     * @return \Illuminate\Support\Collection  
     */
    public function rootReviews(string $order = 'id', string $sort = 'desc', $except = []) : Collection
    {
        return $this->model->whereIsRoot()
                        ->orderBy($order, $sort)
                        ->get()
                        ->except($except);
    }

    /**
     * Create the review
     *
     * @param array $params
     *
     * @return Review
     * @throws ReviewInvalidArgumentException
     * @throws ReviewNotFoundException
     */
    public function createReview(array $params): Review
    {
        try {

            $collection = collect($params);
            if (isset($params['name'])) {
                $slug = str_slug($params['name']);
            }

            if (isset($params['cover']) && ($params['cover'] instanceof UploadedFile)) {
                $cover = $this->uploadOne($params['cover'], 'reviews');
            }

            if (isset($params['background']) && ($params['background'] instanceof UploadedFile)) {
                $background = $this->uploadOne($params['background'], 'reviews');
            }

            $merge = $collection->merge(compact('slug', 'cover', 'background'));

            $review = new Review($merge->all());

            if (isset($params['parent'])) {
                $parent = $this->findReviewById($params['parent']);
                $review->parent()->associate($parent);
            }

            $review->save();
            return $review;
        } catch (QueryException $e) {
            throw new ReviewInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * Update the review
     *
     * @param array $params
     *
     * @return Review
     * @throws ReviewNotFoundException
     */
    public function updateReview(array $params): Review
    {
        $review = $this->findReviewById($this->model->id);
        $collection = collect($params)->except('_token');
        $slug = str_slug($collection->get('name'));

        if (isset($params['cover']) && ($params['cover'] instanceof UploadedFile)) {
            $cover = $this->uploadOne($params['cover'], 'reviews');
        }

        if (isset($params['background']) && ($params['background'] instanceof UploadedFile)) {
            $background = $this->uploadOne($params['background'], 'reviews');
        }

        $merge = $collection->merge(compact('slug', 'cover', 'background'));

        if (isset($params['parent']) && $params['parent'] != 0) {
            $parent = $this->findReviewById($params['parent']);
            $review->parent()->associate($parent);
        }

        $review->update($merge->all());
        return $review;
    }

    /**
     * @param int $id
     *
     * @return Review
     * @throws ReviewNotFoundException
     */
    public function findReviewById(int $id) : Review
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ReviewNotFoundException($e->getMessage());
        }
    }

    /**
     * Delete a review
     *
     * @return bool
     * @throws \Exception
     */
    public function deleteReview() : bool
    {
        return $this->model->delete();
    }

    /**
     * Associate a article in a review
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
     * Return all the articles associated with the review
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
        return $this->update([$file['field'] => null], $file['review']);
    }

    /**
     * Return the review by using the slug as the parameter
     *
     * @param array $slug
     *
     * @return Review
     * @throws ReviewNotFoundException
     */
    public function findReviewBySlug(array $slug) : Review
    {
        try {
            return $this->findOneByOrFail($slug);
        } catch (ModelNotFoundException $e) {
            throw new ReviewNotFoundException($e);
        }
    }

    /**
     * @return mixed
     */
    public function findParentReview()
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
