<?php

namespace Vanguard\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Vanguard\Http\Requests\Request;
use Vanguard\Companies;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // { 
    //     return Auth::check();
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required|string|unique:companies,name,'.$this->id,
            'cif'     => 'required|string|max:255',
            'address' => 'required|string|min:5|max:255',
            'users'   => 'required|string|min:1',
        ];
    }

}
