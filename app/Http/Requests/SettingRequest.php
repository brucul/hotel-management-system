<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'app_name'      => 'required|min:5|max:100',
            'pict'          => 'image',
            'bed'           => 'required|numeric',
            'breakfast'     => 'required|numeric',
            'hotel_name'    => 'required|min:5|max:100',
            'address'       => 'required|max:1000',
            'regency'       => 'required|max:100',
            'province'      => 'required|max:100',
            'phone'         => 'required',
            'number_fax'    => '',
            'email'         => 'required|email',
            'website'       => 'max:100',
        ];
    }

    public $validator = null;

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
