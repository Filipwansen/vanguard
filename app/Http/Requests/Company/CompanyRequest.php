<?php

namespace Vanguard\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required|unique:companies|min:3|max:255',
            'cif'     => 'required|string|max:255',
            'address' => 'required|string|min:5|max:255',
            'users'   => 'required|min:1',
        ];
    }
}
