<?php

namespace App\Http\Requests\Client\Auth;

use App\Base\BaseFormRequest;
use App\Rules\phone;
use Illuminate\Validation\Rule;

class SignUpRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required','email',Rule::unique('users','email')],
            'password' =>   ['required','string','min:4','max:16'],
            'first_name' => ['required','string'],
            'last_name' =>  ['required','string'],
            'phone' => ['nullable', new phone()]
        ];
    }

}
