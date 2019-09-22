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
            'name'     => ['required', 'unique:articles'],
            'title'    => ['required'],
            'cover'    => ['required', 'file', 'image:png,jpeg,jpg,gif'],
            'background' => ['file', 'image:png,jpeg,jpg,gif']
        ];
    }
}
