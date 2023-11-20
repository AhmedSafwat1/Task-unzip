<?php

namespace App\Http\Requests\Zip;

use Illuminate\Foundation\Http\FormRequest;

class ZipRequest extends FormRequest
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
            "zip"=> 'required|file|mimes:zip|max:30072'
        ];
    }
}
