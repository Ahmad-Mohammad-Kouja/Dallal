<?php


namespace App\Base;


use App\traits\FormRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseFormRequest extends FormRequest
{
    use FormRequestTrait;


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

}
