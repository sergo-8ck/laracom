<?php

namespace App\Blog\ReviewImages;

use App\Blog\Reviews\Review;
use Illuminate\Database\Eloquent\Model;

class ReviewImage extends Model
{
    protected $fillable = [
        'review_id',
        'src'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
