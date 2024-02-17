<?php

namespace App\Http\Requests\ComfortCategory;

use Illuminate\Foundation\Http\FormRequest;

class ComfortCategoryRequest extends FormRequest
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
            'comfort_category' => ['required', 'array'],
            'comfort_category.title' => ['required', 'string', 'max:255'],
            'comfort_category.description' => ['required', 'string'],
         ];
    }
}
