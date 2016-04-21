<?php

namespace App\Http\Requests\RecipeRating;

use App\Http\Requests\AbstractRequest;

class CreateRequest extends AbstractRequest
{
    public function rules() : array
    {
        return [
            'rating' => ['required', 'integer', 'between:1,5'],
        ];
    }

    public function authorize() : bool
    {
        return true;
    }

    public function getDeserializedContent()
    {
        return $this->request->get('rating');
    }
}