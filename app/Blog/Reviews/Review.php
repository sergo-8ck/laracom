<?php

namespace App\Blog\Reviews;

use App\Blog\ReviewImages\ReviewImage;
use App\Shop\Customers\Customer;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use NodeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'body',
        'status',
        'images',
        'parent_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ReviewImage::class);
    }
}
