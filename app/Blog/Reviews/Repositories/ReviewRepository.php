<?php

namespace App\Blog\Reviews\Repositories;

use App\Blog\ReviewImages\ReviewImage;
use App\Blog\Reviews\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Shop\Customers\Customer;
use Illuminate\Support\Facades\DB;
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
        return $this->model->query()->orderBy($order, $sort)->get()->except($except);
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

            if (isset($params['images']) && ($params['images'] instanceof UploadedFile)) {
                $background = $this->uploadOne($params['images'], 'reviews');
            }

            $merge = $collection->merge(compact('slug', 'cover', 'background'));

            $review = new Review($merge->all());

            if ($params['parent']) {
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

        if (isset($params['images']) && ($params['images'] instanceof UploadedFile)) {
            $background = $this->uploadOne($params['images'], 'reviews');
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
     * Return the reviews
     *
     * @param int $id
     *
     * @return Review
     * @throws ReviewNotFoundException
     */
    public function findCustomerReviewById(int $id, Customer $customer) : Review
    {
        try
        {
            return $customer
                ->reviews()
                ->whereId($id)
                ->firstOrFail();
        }
        catch (ModelNotFoundException $e)
        {
            throw new ReviewNotFoundException('Review not found.');
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
     * @param Customer $customer
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function associateCustomer(Customer $customer)
    {
        return $this->model->customer()->save($customer);
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
     * @param $file
     * @param null $disk
     * @return bool
     */
    public function deleteFile(array $file, $disk = null) : bool
    {
        return $this->update([$file['field'] => null], $file['review']);
    }

    /**
     * @param string $src
     * @return bool
     */
    public function deleteThumb(string $src) : bool
    {
        return DB::table('review_images')->where('src', $src)->delete();
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

    /**
     * @param Collection $collection
     *
     * @return void
     */
    public function saveReviewImages(Collection $collection)
    {
        $collection->each(function (UploadedFile $file) {
            $filename = $this->storeFile($file, 'reviews');
            $reviewImage = new ReviewImage([
                'article_id' => $this->model->id,
                'src' => $filename
            ]);
            $this->model->images()->save($reviewImage);
        });
    }
}
