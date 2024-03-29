<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            'car' => ['required', 'array'],
            'car.model' => ['required', 'string', 'max:255'],
            'car.booking_status' => ['sometimes', 'boolean'],
            'car.chauffeur' => ['required', 'string', 'max:255'],
        ];
    }
}
