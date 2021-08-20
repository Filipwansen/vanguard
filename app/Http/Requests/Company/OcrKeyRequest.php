<?php

namespace Vanguard\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class OcrKeyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->role->name == 'Admin') return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'company_id'  => 'required|numeric',
            'key'         => 'required|string|min:70|max:70',
            'expire_date' => 'required|date',
        ];
    }
}
