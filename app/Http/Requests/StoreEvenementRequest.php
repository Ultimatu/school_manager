<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvenementRequest extends FormRequest
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
            'titre' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|string',
            'classes_ids' => 'nullable|array',
            'date_heure_debut' => 'required|date',
            'date_time_fin' => 'required|date',
            'send_to_all' => 'required|boolean',
            'salle_id' => 'nullable|exists:salles,id',
            'only_for_admins' => 'required|boolean',
            'only_for_profs' => 'required|boolean',
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
            'titre.required' => 'Le titre est obligatoire',
            'description.required' => 'La description est obligatoire',
            'type.required' => 'Le type est obligatoire',
            'date_heure_debut.required' => 'La date de début est obligatoire',
            'date_time_fin.required' => 'La date de fin est obligatoire',
            'send_to_all.required' => 'Le champ send_to_all est obligatoire',
            'only_for_admins.required' => 'Le champ only_for_admins est obligatoire',
            'only_for_profs.required' => 'Le champ only_for_profs est obligatoire',

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
            'titre' => 'titre de l\'événement',
            'description' => 'description de l\'événement',
            'type' => 'type de l\'événement',
            'classes_ids' => 'Les classes concernées',
            'date_heure_debut' => 'Date de début',
            'date_time_fin' => 'Date de fin',
            'send_to_all' => 'Envoyer à tous',
            'salle_id' => 'salle_id',
            'only_for_admins' => 'Reservé aux admins',
            'only_for_profs' => 'Reservé aux professeurs',
        ];
    }
}
