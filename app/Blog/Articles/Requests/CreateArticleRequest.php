<?php

namespace App\Blog\Articles\Requests;

use App\Shop\Base\BaseFormRequest;

class CreateArticleRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'            => ['required', 'unique:articles'],
            'title_h1'        => ['required'],
            'description'     => ['max:170'],
            'seo_description' => ['max:170'],
            'cover'           => ['file', 'image:png,jpeg,jpg,gif'],
            'background'      => ['file', 'image:png,jpeg,jpg,gif'],
        ];
    }
}
