<?php

namespace App\Blog\ReviewImages;

use Jsdecena\Baserepo\BaseRepository;
use App\Blog\Reviews\Review;

class ReviewImageRepository extends BaseRepository
{
    /**
     * ReviewImageRepository constructor.
     *
     * @param ReviewImage $reviewImage
     */
    public function __construct(ReviewImage $reviewImage)
    {
        parent::__construct($reviewImage);
        $this->model = $reviewImage;
    }

    /**
     * @return mixed
     */
    public function findReview() : Review
    {
        return $this->model->review;
    }
}
