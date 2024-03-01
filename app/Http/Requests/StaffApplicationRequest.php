<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'=>['email'],
            'omang'=>['string', 'max:60'],
            'passport_number'=>['string', 'max:60'],
            'phone'=>['string', 'max:60'],
            'country_of_origin'=>['string', 'max:255']
        ];
    }
}
