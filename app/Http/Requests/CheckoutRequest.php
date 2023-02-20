<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'discount_code_hidden' => 'string|exists:discount_codes,code',
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable',
            'address' => 'required|string',
            'phone' => 'required|numeric',
            'country' => 'required|string',
            'city' => 'required|string',
            'zip' => 'required|numeric',
        ];
    }
}
