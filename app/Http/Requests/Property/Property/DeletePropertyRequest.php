<?php

namespace App\Http\Requests\Property\Property;

use App\Base\BaseFormRequest;
use App\Classes\ResponseHelper;
use App\classes\ValidateHelper;
use App\Models\Property\Property;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class DeletePropertyRequest extends BaseFormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'property_id' =>['required','integer',Rule::exists('properties','id')
                ->whereNull('deleted_at')],
        ];
    }

}
