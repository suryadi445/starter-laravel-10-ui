<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NavigationRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'url' => 'required|string|max:100',
            'sort' => 'integer|nullable',
            'icon' => 'string|max:100|nullable',
            'main_menu' => 'string|max:100|nullable',
            'role' => 'required|max:100',
        ];
    }
}
