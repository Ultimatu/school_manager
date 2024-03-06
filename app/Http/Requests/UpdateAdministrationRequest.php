<?php

namespace App\Http\Requests;

use App\Models\AnneeScolaire;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdministrationRequest extends FormRequest
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
            'id' => 'required|integer|exists:administrations,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user_id,
            'phone' => 'required|string|max:20|unique:users,phone,'.$this->user_id,
            'address' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'responsability' => 'required|string',
            'gender' => 'required|string|max:2',
            'user_id' => 'required|integer|exists:users,id'
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
            'email.required' => 'L\'email est obligatoire',
            'phone.required' => 'Le téléphone est obligatoire',
            'address.required' => 'L\'adresse est obligatoire',
            'role.required' => 'Le rôle est obligatoire',
            'responsability.required' => 'La responsabilité est obligatoire',
            'user_id.required' => 'L\'identifiant de l\'utilisateur est obligatoire',
            'user_id.integer' => 'L\'identifiant de l\'utilisateur doit être un entier',
            'user_id.exists' => 'L\'identifiant de l\'utilisateur n\'existe pas',
        ];
    }

    public function prepareForValidation()
    {
        $annneScolaire = AnneeScolaire::where('status', 'en cours')->first();
        $this->merge([
            'annee_scolaire' => $this->annee_scolaire = $annneScolaire->annee_scolaire,
        ]);
    }

}
