<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class GuestRequest extends FormRequest
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
            'name'              => 'required|min:5|max:100',
            'type'              => 'required',
            'nik'               => 'required|min:5|max:100',
            'email'             => 'required|email',
            'phone'             => 'required|min:5|max:15',
            'address'           => 'required|min:5|max:100',
            'city'              => 'required|min:3|max:100',
            'country'           => 'required|min:3|max:100',
            'additional_info'   => 'max:1000',
        ];
    }

    public $validator = null;

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
