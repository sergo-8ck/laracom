<?php

namespace App\Blog\Sections\Requests;

use App\Blog\Base\BaseFormRequest;

class CreateSectionRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:sections']
        ];
    }
}
