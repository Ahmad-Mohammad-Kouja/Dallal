<?php


namespace App\traits;


use App\Classes\validatorHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FormRequestTrait
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        if($this->expectsJson())
        {
            $validatorHelper = new validatorHelper($validator->errors());
            throw new HttpResponseException($validatorHelper->checkErrors());
        }
        parent::failedValidation($validator);
    }
}
