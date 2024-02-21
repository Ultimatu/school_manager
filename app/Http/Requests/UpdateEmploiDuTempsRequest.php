<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmploiDuTempsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (auth()->user()->isConsellor() || auth()->user()->isDirector()) {
            return true;
        }
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
            'id' => 'required|integer|exists:emploi_du_temps,id', // 'id' => 'required|integer|exists:emploi_du_temps,id
            'classe_id' => 'required|integer|exists:classes,id',
            'professeur_id' => 'required|integer|exists:professeurs,id',
            'salle_id' => 'required|integer|exists:salles,id',
            'classe_cours_id' => 'required|integer|exists:classe_cours,id',
            'day' => 'required|string',
            'start_date_time' => 'required|date',
            'end_date_time' => 'required|date',
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
            'id.required' => 'L\'identifiant de l\'emploi du temps est obligatoire',
            'classe_id.required' => 'L\'identifiant de la classe est obligatoire',
            'professeur_id.required' => 'L\'identifiant du professeur est obligatoire',
            'salle_id.required' => 'L\'identifiant de la salle est obligatoire',
            'classe_cours_id.required' => 'L\'identifiant du cours est obligatoire',
            'day.required' => 'Le jour est obligatoire',
            'start_date_time.required' => 'L\'heure de début est obligatoire',
            'end_date_time.required' => 'L\'heure de fin est obligatoire',
        ];
    }



    /**
     * validation attributes
     *
     */
    public function attributes(): array
    {
        return [
            'id' => 'identifiant',
            'classe_id' => 'identifiant de la classe',
            'professeur_id' => 'identifiant du professeur',
            'salle_id' => 'identifiant de la salle',
            'classe_cours_id' => 'identifiant du cours',
            'day' => 'jour',
            'start_date_time' => 'heure de début',
            'end_date_time' => 'heure de fin',
        ];
    }
}
