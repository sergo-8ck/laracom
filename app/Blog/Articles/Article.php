<?php

namespace App\Blog\Articles;

use App\Shop\Brands\Brand;
use App\Blog\Sections\Section;
use App\Blog\ArticleAttributes\ArticleAttribute;
use App\Blog\ArticleImages\ArticleImage;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Nicolaslopezj\Searchable\SearchableTrait;

class Article extends Model implements Buyable
{
    use SearchableTrait;

    public const MASS_UNIT = [
        'OUNCES' => 'oz',
        'GRAMS' => 'gms',
        'POUNDS' => 'lbs'
    ];

    public const DISTANCE_UNIT = [
        'CENTIMETER' => 'cm',
        'METER' => 'mtr',
        'INCH' => 'in',
        'MILIMETER' => 'mm',
        'FOOT' => 'ft',
        'YARD' => 'yd'
    ];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'products.name' => 10,
            'products.description' => 5
        ]
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku',
        'name',
        'description',
        'cover',
        'quantity',
        'price',
        'brand_id',
        'status',
        'weight',
        'mass_unit',
        'status',
        'sale_price',
        'length',
        'width',
        'height',
        'distance_unit',
        'slug',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function categories()
    {
        return $this->belongsToMany(Section::class);
    }

    /**
     * Get the identifier of the Buyable item.
     *
     * @param null $options
     * @return int|string
     */
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @param null $options
     * @return string
     */
    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    /**
     * Get the price of the Buyable item.
     *
     * @param null $options
     * @return float
     */
    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ArticleImage::class);
    }

    /**
     * @param string $term
     * @return Collection
     */
    public function searchProduct(string $term) : Collection
    {
        return self::search($term)->get();
    }
}
