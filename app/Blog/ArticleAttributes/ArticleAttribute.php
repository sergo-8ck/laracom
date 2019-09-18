<?php

namespace App\Blog\ArticleAttributes;

use App\Shop\AttributeValues\AttributeValue;
use App\Blog\Articles\Article;
use Illuminate\Database\Eloquent\Model;

class ArticleAttribute extends Model
{
    protected $fillable = [
        'quantity',
        'price',
        'sale_price',
        'default'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributesValues()
    {
        return $this->belongsToMany(AttributeValue::class);
    }
}
