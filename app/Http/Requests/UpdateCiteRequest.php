<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id'=> 'required|exists:cites,id',
            'name' => 'required|string|max:255|unique:cites',
            'status' => 'required|string',
            'capacity' => 'required|integer',
            'slug' => 'required|string|unique:cites,slug',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'address'=> 'nullable|string'
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
            'id.required' => 'L\'id de la cité est requis',
            'name.required' => 'Le nom est obligatoire',
            'status.required' => 'Le statut est obligatoire',
            'capacity.required' => 'La capacité est obligatoire',
            'slug.required' => 'Le slug est obligatoire',
            'slug.unique' => 'Le slug doit être unique',
            'type.required' => 'Le type est obligatoire'
        ];
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'id' => 'Id de la cité',
            'name' => 'Nom',
            'status' => 'Statut',
            'capacity' => 'Capacité',
            'slug' => 'Slug',
            'description' => 'Description',
            'type' => 'Type',
            'address' => 'Adresse'
        ];
    }


    //befor validation
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => \Str::slug($this->name.'-'.\Str::random(6).'-'.\Str::random(6))
        ]);
    }
}
