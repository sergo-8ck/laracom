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
            'name'            => ['required', Rule::unique('articles')->ignore($this->segment(3))],
            'description'     => ['required', 'max:170'],
            'seo_description' => ['max:170'],
        ];
    }
}
