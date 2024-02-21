<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoursRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'is_available' => 'required|boolean',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom du cours est obligatoire',
            'description.required' => 'La description du cours est obligatoire',
            'is_available.required' => 'La disponibilité du cours est obligatoire',
            'avatar.image' => 'L\'avatar doit être une image',
            'avatar.mimes' => 'L\'avatar doit être une image de type: jpeg, png, jpg, gif, svg',
            'avatar.max' => 'L\'avatar ne doit pas dépasser 2 Mo',
        ];
    }



    /**
     * validation attributes
     *
     */
    public function attributes(): array
    {
        return [
            'name' => 'nom',
            'description' => 'description',
            'is_available' => 'disponibilité',
            'avatar' => 'image',
        ];
    }
}
