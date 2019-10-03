<?php

namespace App\Blog\Reviews;

use App\Blog\Articles\Article;
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
        'name',
        'body',
        'customer_id',
        'article_id',
        'status',
        'parent_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'section_article');
    }
}
