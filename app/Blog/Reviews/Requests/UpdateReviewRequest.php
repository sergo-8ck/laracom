<?php

namespace App\Blog\Reviews\Requests;

use App\Blog\Base\BaseFormRequest;

class UpdateReviewRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => ['required']
        ];
    }
}
