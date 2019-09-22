<?php

namespace App\Blog\Articles\Transformations;

use App\Blog\Articles\Article;
use Illuminate\Support\Facades\Storage;

trait ArticleTransformable
{
    /**
     * Transform the article
     *
     * @param Article $article
     *
     * @return Article
     */
    protected function transformArticle(Article $article)
    {
        $prod                  = new Article;
        $prod->id              = (int)$article->id;
        $prod->name            = $article->name;
        $prod->title           = $article->title;
        $prod->title_h1        = $article->title_h1;
        $prod->slug            = $article->slug;
        $prod->description     = $article->description;
        $prod->content         = $article->content;
        $prod->cover           = asset("storage/$article->cover");
        $prod->background      = asset("storage/$article->background");
        $prod->seo_keywords    = $article->seo_keywords;
        $prod->seo_description = $article->seo_description;
        $prod->status          = $article->status;
        $prod->mass_unit       = $article->mass_unit;

        return $prod;
    }
}
