<?php

namespace App\Http\Requests\Property\Property;

use App\Base\BaseFormRequest;
use App\classes\ResponseHelper;
use App\classes\ValidateHelper;
use App\Enums\Properties\PropertyUseTypes;
use App\Models\Address\Area;
use App\Models\Property\Property;
use App\Models\Property\Type;
use App\Models\Property\TypeOption;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdatePropertyRequest extends BaseFormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //Property
            'property_id' => ['required','integer',Rule::exists('properties','id')
            ->whereNull('deleted_at')],
            'type_id' => ['required','integer',Rule::exists('types','id')],
            'area_id' => ['integer',Rule::exists('areas','id')],
            'address' => ['required','string'],
            'description' => ['required','string'],
            'price' => ['required','integer'],
            'img' => ['required','string'],
            'space' => ['required','numeric'],
            'longitude' => ['nullable','numeric'],
            'latitude' => ['nullable','numeric'],
            'postal_code' => ['nullable','string'],
            'use_type' => ['required',new EnumValue(PropertyUseTypes::class)],
            //img
            'images'=>['nullable','array'],
            'images.*'=>['required','string'],
            //ProductSpec
            'specs'=>['required','array'],
            'specs.*.id'=>['required','integer'],
            'specs.*.option'=>['required','array'],
            'specs.*.option.*'=>['required','integer'],

            'deleted_img'=>['array'],
            'deleted_img.*'=>['string']
        ];
    }

}
