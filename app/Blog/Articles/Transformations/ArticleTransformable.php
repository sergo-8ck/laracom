<?php

namespace App\Blog\Articles\Transformations;

use App\Blog\Articles\Article;
use Illuminate\Support\Facades\Storage;

trait ArticleTransformable
{
    /**
     * Transform the product
     *
     * @param Article $product
     *
     * @return Article
     */
    protected function transformProduct(Article $product)
    {
        $prod              = new Article;
        $prod->id          = (int) $product->id;
        $prod->name        = $product->name;
        $prod->sku         = $product->sku;
        $prod->slug        = $product->slug;
        $prod->description = $product->description;
        $prod->cover       = asset("storage/$product->cover");
        $prod->quantity    = $product->quantity;
        $prod->price       = $product->price;
        $prod->status      = $product->status;
        $prod->weight      = (float) $product->weight;
        $prod->mass_unit   = $product->mass_unit;
        $prod->sale_price = $product->sale_price;
        $prod->brand_id = (int) $product->brand_id;

        return $prod;
    }
}
