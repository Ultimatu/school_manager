<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentEtudiantRequest extends FormRequest
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
            'etudiant_ids' => 'required|array',
            'appointment_id' => 'required|exists:appointments,id',
            'selected_are_present' => 'required|boolean',   
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
            'etudiant_ids.required' => 'L\'étudiant est obligatoire',
            'etudiant_ids.array' => 'L\'étudiant doit être un tableau',
            'appointment_id.required' => 'L\'appointment est obligatoire',
            'appointment_id.exists' => 'L\'appointment n\'existe pas',
            'selected_are_present.required' => 'Veuillez preciser si les gens selectionnés sont présentes ou absentes',
            'selected_are_present.boolean' => 'La présence doit être un boolean',
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
            'etudiant_ids' => 'Etudiants',
            'appointment_id' => 'Appointment',
            'selected_are_present' => 'Présence',
        ];
    }


    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array<string, string>
     */
    protected function prepareForValidation():void
    {
        $this->merge([
            'selected_are_present' => $this->selected_are_present == 'true' ? true : false,
        ]);
    }
}
