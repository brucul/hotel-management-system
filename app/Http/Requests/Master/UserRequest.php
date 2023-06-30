<?php

namespace App\Http\Requests\Master;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|min:3|max:100',
            'email'     => 'required|email',
            // 'password'  => 'min:8|max:100',
        ];
    }

    public $validator = null;

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
