<?php

namespace App\Blog\Articles\Requests;

use App\Shop\Base\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sku' => ['required'],
            'name' => ['required', Rule::unique('products')->ignore($this->segment(3))],
            'quantity' => ['required', 'integer'],
            'price' => ['required']
        ];
    }
}
