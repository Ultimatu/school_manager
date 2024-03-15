<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentEtudiantRequest extends FormRequest
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
            'appointment_id' => 'required|integer|exists:appointments,id',
            'etudiant_id' => 'required|integer|exists:etudiants,id',
            'is_present' => 'required|boolean',
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
            'appointment_id' => 'appointment',
            'etudiant_id' => 'etudiant',
            'is_present' => 'is present',
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
            'appointment_id.required' => 'L\'appointment est obligatoire',
            'appointment_id.integer' => 'L\'appointment doit être un entier',
            'appointment_id.exists' => 'L\'appointment n\'existe pas',
            'etudiant_id.required' => 'L\'etudiant est obligatoire',
            'etudiant_id.integer' => 'L\'etudiant doit être un entier',
            'etudiant_id.exists' => 'L\'etudiant n\'existe pas',
            'is_present.required' => 'La présence est obligatoire',
            'is_present.boolean' => 'La présence doit être un boolean',
        ];
    }



    protected function prepareForValidation()
    {
        $this->merge([
            'appointment_id' => (int)$this->appointment_id,
            'etudiant_id' => (int)$this->etudiant_id,
            'is_present' => (bool)$this->is_present,
        ]);
    }

}
