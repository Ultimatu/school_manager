<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParentsRequest extends FormRequest
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
            'id' => 'required|exists:parents,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:users',
            'address' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'is_legal_tutor' => 'required|boolean',
            'status' => 'required|boolean',
            'etudiants_ids' => 'required',
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
            'id.required' => 'L\'identifiant est obligatoire',
            'first_name.required' => 'Le prénom est obligatoire',
            'last_name.required' => 'Le nom est obligatoire',
            'phone.required' => 'Le numéro de téléphone est obligatoire',
            'address.required' => 'L\'adresse est obligatoire',
            'profession.required' => 'La profession est obligatoire',
            'is_legal_tutor.required' => 'Le statut de tuteur légal est obligatoire',
            'status.required' => 'Le statut est obligatoire',
            'etudiants_ids.required' => 'L\'étudiant est obligatoire',
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
            'id' => 'identifiant',
            'first_name' => 'prénom',
            'last_name' => 'nom',
            'phone' => 'numéro de téléphone',
            'address' => 'adresse',
            'profession' => 'profession',
            'is_legal_tutor' => 'statut de tuteur légal',
            'status' => 'statut',
            'etudiants_ids' => 'étudiant',
        ];
    }
}
