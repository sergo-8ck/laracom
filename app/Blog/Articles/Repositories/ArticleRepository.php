<?php

namespace App\Blog\Articles\Repositories;

use App\Shop\AttributeValues\AttributeValue;
use App\Shop\Products\Exceptions\ProductCreateErrorException;
use App\Blog\Articles\Exceptions\ArticleUpdateErrorException;
use App\Shop\Tools\UploadableTrait;
use Jsdecena\Baserepo\BaseRepository;
use App\Shop\Brands\Brand;
use App\Blog\ArticleAttributes\ArticleAttribute;
use App\Blog\ArticleImages\ArticleImage;
use App\Blog\Articles\Exceptions\ArticleNotFoundException;
use App\Blog\Articles\Article;
use App\Blog\Articles\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Shop\Products\Transformations\ArticleTransformable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{
    use ArticleTransformable, UploadableTrait;

    /**
     * ProductRepository constructor.
     *
     * @param Article $product
     */
    public function __construct(Article $product)
    {
        parent::__construct($product);
        $this->model = $product;
    }

    /**
     * List all the products
     *
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return Collection
     */
    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Collection
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * Create the product
     *
     * @param array $data
     *
     * @return Article
     * @throws ProductCreateErrorException
     */
    public function createProduct(array $data): Article
    {
        try {
            return $this->create($data);
        } catch (QueryException $e) {
            throw new ProductCreateErrorException($e);
        }
    }

    /**
     * Update the product
     *
     * @param array $data
     *
     * @return bool
     * @throws ArticleUpdateErrorException
     */
    public function updateProduct(array $data) : bool
    {
        $filtered = collect($data)->except('image')->all();

        try {
            return $this->model->where('id', $this->model->id)->update($filtered);
        } catch (QueryException $e) {
            throw new ArticleUpdateErrorException($e);
        }
    }

    /**
     * Find the product by ID
     *
     * @param int $id
     *
     * @return Article
     * @throws ArticleNotFoundException
     */
    public function findProductById(int $id): Article
    {
        try {
            return $this->transformProduct($this->findOneOrFail($id));
        } catch (ModelNotFoundException $e) {
            throw new ArticleNotFoundException($e);
        }
    }

    /**
     * Delete the product
     *
     * @param Article $product
     *
     * @return bool
     * @throws \Exception
     * @deprecated
     * @use removeProduct
     */
    public function deleteProduct(Article $product) : bool
    {
        $product->images()->delete();
        return $product->delete();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function removeProduct() : bool
    {
        return $this->model->where('id', $this->model->id)->delete();
    }

    /**
     * Detach the categories
     */
    public function detachCategories()
    {
        $this->model->categories()->detach();
    }

    /**
     * Return the categories which the product is associated with
     *
     * @return Collection
     */
    public function getCategories() : Collection
    {
        return $this->model->categories()->get();
    }

    /**
     * Sync the categories
     *
     * @param array $params
     */
    public function syncCategories(array $params)
    {
        $this->model->categories()->sync($params);
    }

    /**
     * @param $file
     * @param null $disk
     * @return bool
     */
    public function deleteFile(array $file, $disk = null) : bool
    {
        return $this->update(['cover' => null], $file['product']);
    }

    /**
     * @param string $src
     * @return bool
     */
    public function deleteThumb(string $src) : bool
    {
        return DB::table('product_images')->where('src', $src)->delete();
    }

    /**
     * Get the product via slug
     *
     * @param array $slug
     *
     * @return Article
     * @throws ArticleNotFoundException
     */
    public function findProductBySlug(array $slug): Article
    {
        try {
            return $this->findOneByOrFail($slug);
        } catch (ModelNotFoundException $e) {
            throw new ArticleNotFoundException($e);
        }
    }

    /**
     * @param string $text
     * @return mixed
     */
    public function searchProduct(string $text) : Collection
    {
        if (!empty($text)) {
            return $this->model->searchProduct($text);
        } else {
            return $this->listProducts();
        }
    }

    /**
     * @return mixed
     */
    public function findProductImages() : Collection
    {
        return $this->model->images()->get();
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function saveCoverImage(UploadedFile $file) : string
    {
        return $file->store('products', ['disk' => 'public']);
    }

    /**
     * @param Collection $collection
     *
     * @return void
     */
    public function saveProductImages(Collection $collection)
    {
        $collection->each(function (UploadedFile $file) {
            $filename = $this->storeFile($file);
            $productImage = new ArticleImage([
                'product_id' => $this->model->id,
                'src' => $filename
            ]);
            $this->model->images()->save($productImage);
        });
    }

    /**
     * Associate the product attribute to the product
     *
     * @param ArticleAttribute $productAttribute
     *
     * @return ArticleAttribute
     */
    public function saveProductAttributes(ArticleAttribute $productAttribute): ArticleAttribute
    {
        $this->model->attributes()->save($productAttribute);
        return $productAttribute;
    }

    /**
     * List all the product attributes associated with the product
     *
     * @return Collection
     */
    public function listProductAttributes() : Collection
    {
        return $this->model->attributes()->get();
    }

    /**
     * Delete the attribute from the product
     *
     * @param ArticleAttribute $productAttribute
     *
     * @return bool|null
     * @throws \Exception
     */
    public function removeProductAttribute(ArticleAttribute $productAttribute) : ?bool
    {
        return $productAttribute->delete();
    }

    /**
     * @param ArticleAttribute $productAttribute
     * @param AttributeValue   ...$attributeValues
     *
     * @return Collection
     */
    public function saveCombination(ArticleAttribute $productAttribute, AttributeValue ...$attributeValues) : Collection
    {
        return collect($attributeValues)->each(function (AttributeValue $value) use ($productAttribute) {
            return $productAttribute->attributesValues()->save($value);
        });
    }

    /**
     * @return Collection
     */
    public function listCombinations() : Collection
    {
        return $this->model->attributes()->map(function (ArticleAttribute $productAttribute) {
            return $productAttribute->attributesValues;
        });
    }

    /**
     * @param ArticleAttribute $productAttribute
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findProductCombination(ArticleAttribute $productAttribute)
    {
        $values = $productAttribute->attributesValues()->get();

        return $values->map(function (AttributeValue $attributeValue) {
            return $attributeValue;
        })->keyBy(function (AttributeValue $item) {
            return strtolower($item->attribute->name);
        })->transform(function (AttributeValue $value) {
            return $value->value;
        });
    }

    /**
     * @param Brand $brand
     */
    public function saveBrand(Brand $brand)
    {
        $this->model->brand()->associate($brand);
    }

    /**
     * @return Brand
     */
    public function findBrand()
    {
        return $this->model->brand;
    }
}
