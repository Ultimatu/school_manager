<?php

namespace App\Http\Requests;

use App\Models\AnneeScolaire;
use App\Models\ClasseCours;
use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !auth()->user()->isEtudiant();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'day' => 'required|string',
            'date' => 'required|date',
            'start_date' => 'required|date_format:H:i',
            'end_date' => 'required|date_format:H:i|after:start_date',
            'annee_scolaire' => 'required|string',
            'classe_id' => 'required|exists:classes,id',
            'professeur_id' => 'required|exists:professeurs,id',
            'classe_cours_id' => 'required|exists:classe_cours,id',
        ];
    }


    public function messages()
    {
        return [
            'day.required' => 'Le jour est obligatoire',
            'date.required' => 'La date est obligatoire',
            'date.date' => 'La date est invalide',
            'start_date.required' => 'L\'heure de début est obligatoire',
            'start_date.date_format' => 'L\'heure de début est invalide',
            'end_date.required' => 'L\'heure de fin est obligatoire',
            'end_date.date_format' => 'L\'heure de fin est invalide',
            'end_date.after' => 'L\'heure de fin doit être supérieure à l\'heure de début',
            'annee_scolaire.required' => 'L\'année scolaire est obligatoire',
            'classe_id.required' => 'La classe est obligatoire',
            'classe_id.exists' => 'La classe est invalide',
            'professeur_id.required' => 'Le professeur est obligatoire',
            'professeur_id.exists' => 'Le professeur est invalide',
            'classe_cours_id.required' => 'Le cours est obligatoire',
            'classe_cours_id.exists' => 'Le cours est invalide',
        ];
    }


    protected function prepareForValidation()
    {
        $classeCours = ClasseCours::find($this->classe_cours_id);
        $this->merge([
            'day'=>$this->getDay($this->date),
            'annee_scolaire'=>AnneeScolaire::valideYear(),
            'classe_id'=>$classeCours->classe_id,
            'professeur_id'=>$classeCours->professeur_id,
        ]);
    }


    public function attributes()
    {
        return [
            'day' => 'jour',
            'date' => 'date',
            'start_date' => 'heure de début',
            'end_date' => 'heure de fin',
            'annee_scolaire' => 'année scolaire',
            'classe_id' => 'classe',
            'professeur_id' => 'professeur',
            'classe_cours_id' => 'cours',
        ];
    }


    private function getDay($date){
        $days = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        return $days[date('w', strtotime($date))];
    }
}
