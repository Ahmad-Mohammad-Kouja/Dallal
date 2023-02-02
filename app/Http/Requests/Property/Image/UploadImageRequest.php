<?php

namespace App\Http\Requests\Property\Image;

use App\Base\BaseFormRequest;
use App\Classes\ResponseHelper;
use App\Enums\General\StorageTypes;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UploadImageRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|mimes:jpg,jpeg,png,jfif',
            'image_type' => 'required',new EnumValue(StorageTypes::class)
        ];
    }

}
