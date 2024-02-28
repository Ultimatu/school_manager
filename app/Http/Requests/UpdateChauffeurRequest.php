<?php

namespace App\Http\Requests;

use App\Models\AnneeScolaire;
use Illuminate\Foundation\Http\FormRequest;

class UpdateChauffeurRequest extends FormRequest
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
            'id'=> 'required|exists:chauffeurs,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'avatar' => 'nullable|image',
            'status' => 'required|string',
            'car_id' => 'required|exists:cars,id',
            'trajet_id' => 'required|exists:trajets,id',
            'annee_scolaire' => 'required|string',
            'slug'=> 'required|string|unique:chauffeurs,slug'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     */
    public function messages(): array
    {
        return [
            'id.required' => 'L\'id du chauffeur est requis',
            'id.exists' => 'L\'id du chauffeur est invalide',
            'first_name.required' => 'Le nom est obligatoire',
            'last_name.required' => 'Le prénom est obligatoire',
            'phone.required' => 'Le téléphone est obligatoire',
            'address.required' => 'L\'adresse est obligatoire',
            'status.required' => 'Le statut est obligatoire',
            'car_id.required' => 'La voiture est obligatoire',
            'trajet_id.required' => 'Le trajet est obligatoire',
            'annee_scolaire.required' => 'L\'année scolaire est obligatoire',
            'slug.required' => 'Le slug est obligatoire',
            'slug.unique' => 'Le slug doit être unique',
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
            'id'=> 'l\'identifiant',
            'first_name' => 'le nom',
            'last_name' => 'le prénom',
            'phone' => 'téléphone',
            'address' => 'adresse',
            'status' => 'statut',
            'car_id' => 'voiture',
            'trajet_id' => 'trajet',
            'annee_scolaire' => 'année scolaire',
            'slug' => 'slug',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => \Str::slug($this->first_name.'-'.$this->last_name.'-'.$this->trajet_id),
            'annee_scolaire' => AnneeScolaire::where('status', 'en cours')->first()->annee_scolaire,
        ]);
    }
}
