<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFiliereRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
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
            'name.required' => 'Le nom de la filière est obligatoire',
            'description.required' => 'La description de la filière est obligatoire',
            'image.image' => 'L\'image doit être une image',
            'image.mimes' => 'L\'image doit être une image de type: jpeg, png, jpg, gif, svg',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo',
            'status.required' => 'La disponibilité de la filière est obligatoire',
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
            'image' => 'image',
            'status' => 'disponibilité',
        ];
    }
}
