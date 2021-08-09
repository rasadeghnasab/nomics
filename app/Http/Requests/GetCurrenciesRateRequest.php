<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetCurrenciesRateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // there is no specific authorization needed here
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
            'ids' => ['required'],
            'per-page' => ['numeric', 'gt:0']
        ];
    }
}
