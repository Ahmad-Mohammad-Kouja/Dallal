<?php

namespace App\Http\Requests\Property\Property;

use App\Base\BaseFormRequest;
use App\Classes\ResponseHelper;
use App\Classes\ValidateHelper;
use App\Enums\Properties\PropertyUseTypes;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class GetPropertiesRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type_id' => ['nullable','integer',Rule::exists('types','id')],
            'area_id' => ['nullable','integer',Rule::exists('areas','id')],
            'filter' => ['nullable','array'],
            'filter.*.type_spec_id' => ['integer'],
            'filter.*.type_option_id' => ['integer'],
            'min_price' => ['nullable','numeric'],
            'max_price' => ['nullable','numeric'],
            'search_range' => ['nullable','numeric'],
            'longitude' => ['nullable','numeric',Rule::requiredIf(function (){
                return $this->has('search_range');
            })],
            'latitude' => ['nullable','numeric',Rule::requiredIf(function ()
            {
                return $this->has('search_range');
            })],
            'min_space' => ['nullable','numeric'],
            'max_space' => ['nullable','numeric'],
            'use_type' => ['nullable',new EnumValue(PropertyUseTypes::class)],
        ];
    }

}
