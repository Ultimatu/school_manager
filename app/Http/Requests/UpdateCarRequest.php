<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
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
            'matricule' => 'required|string|max:255|unique:cars',
            'marque' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status'=>'required|string'
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
            'matricule.required' => 'Le matricule est obligatoire',
            'marque.required' => 'La marque est obligatoire',
            'model.required' => 'Le model est obligatoire',
            'type.required' => 'Le type est obligatoire',
            'status.required' => 'Le statut est obligatoire'
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
            'matricule' => 'Matricule',
            'marque' => 'Marque',
            'model' => 'Model',
            'type' => 'Type',
            'status' => 'Statut'
        ];
    }
}
