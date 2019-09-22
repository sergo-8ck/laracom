<?php

namespace App\Blog\Sections;

use App\Blog\Articles\Article;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use NodeTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'title',
        'title_h1',
        'description',
        'content',
        'seo_keyword',
        'seo_description',
        'cover',
        'background',
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
