<?php

namespace App\Http\Requests\Client\Favorite;

use App\Base\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateFavoriteRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'property_id' => ['required','integer',Rule::exists('properties','id')
            ->whereNull('deleted_at')],
        ];
    }
}
