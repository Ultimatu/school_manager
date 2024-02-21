<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfesseurRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'matricule' => 'required|string|max:255',
            'specialities' => 'required|string|max:255',
            'is_available' => 'required|boolean',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'first_name.required' => 'Le prénom du professeur est obligatoire',
            'first_name.string' => 'Le prénom du professeur doit être une chaîne de caractères',
            'first_name.max' => 'Le prénom du professeur ne peut pas dépasser 255 caractères',
            'last_name.required' => 'Le nom du professeur est obligatoire',
            'last_name.string' => 'Le nom du professeur doit être une chaîne de caractères',
            'last_name.max' => 'Le nom du professeur ne peut pas dépasser 255 caractères',
            'email.required' => 'L\'email du professeur est obligatoire',
            'email.email' => 'L\'email du professeur doit être une adresse email valide',
            'email.unique' => 'Cet email est déjà utilisé',
            'phone.required' => 'Le téléphone du professeur est obligatoire',
            'phone.string' => 'Le téléphone du professeur doit être une chaîne de caractères',
            'phone.max' => 'Le téléphone du professeur ne peut pas dépasser 255 caractères',
            'address.required' => 'L\'adresse du professeur est obligatoire',
            'address.string' => 'L\'adresse du professeur doit être une chaîne de caractères',
            'address.max' => 'L\'adresse du professeur ne peut pas dépasser 255 caractères',
            'matricule.required' => 'Le matricule du professeur est obligatoire',
            'matricule.string' => 'Le matricule du professeur doit être une chaîne de caractères',
            'matricule.max' => 'Le matricule du professeur ne peut pas dépasser 255 caractères',
            'specialities.required' => 'Les spécialités du professeur sont obligatoires',
            'specialities.string' => 'Les spécialités du professeur doivent être une chaîne de caractères',
            'specialities.max' => 'Les spécialités du professeur ne peuvent pas dépasser 255 caractères',
            'is_available.required' => 'La disponibilité du professeur est obligatoire',
            'is_available.boolean' => 'La disponibilité du professeur doit être un booléen',
            'avatar.image' => 'L\'avatar du professeur doit être une image',
            'avatar.mimes' => 'L\'avatar du professeur doit être de type jpeg, png, jpg, gif, svg',
            'avatar.max' => 'L\'avatar du professeur ne peut pas dépasser 2048 kilo-octets',
            'user_id.required' => 'L\'identifiant de l\'utilisateur est obligatoire',
            'user_id.integer' => 'L\'identifiant de l\'utilisateur doit être un entier',
            'user_id.exists' => 'L\'utilisateur n\'existe pas',
        ];

    }


}
