<?php

namespace App\Http\Requests;

use App\Models\ClasseCours;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmploiDuTempsRequest extends FormRequest
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
            'classe_id' => 'required|integer|exists:classes,id',
            'professeur_id' => 'required|integer|exists:professeurs,id',
            'salle_id' => 'required|integer|exists:salles,id',
            'classe_cours_id' => 'required|integer|exists:classe_cours,id',
            'day' => 'required|string',
            'start_date_time' => 'required|date_format:Y-m-d H:i|date',
            'end_date_time' => 'required|date_format:Y-m-d H:i|date|after:start_date_time',
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
            'classe_id' => 'identifiant de la classe',
            'professeur_id' => 'identifiant du professeur',
            'salle_id' => 'identifiant de la salle',
            'classe_cours_id' => 'identifiant du cours',
            'day' => 'jour',
            'start_date_time' => 'heure de début',
            'end_date_time' => 'heure de fin',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $classeCours = ClasseCours::find($this->classe_cours_id);
        $this->merge([
            'classe_id' => $classeCours->classe_id,
            'professeur_id' => $classeCours->professor_id,
            'day' => $this->day,
            'start_date_time' => $this->start_date_time,
            'end_date_time' => $this->end_date_time,
        ]);
    }

}
