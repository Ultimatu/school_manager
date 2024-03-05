<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReclamantionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isEtudiant() && $this->status !== 'resolved';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'etudiant_id' => 'required|exists:etudiants,id',
            'evaluation_id' => 'required_if:status,pending',
            'examen_id' => 'required_if:status,pending',
            'message' => 'required|string',
            'file' => 'nullable|file',
            'status' => 'required|string',
            'date' => 'required|date',
            'objet' => 'required|string',
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
            'etudiant_id.required' => 'L\'id de l\'étudiant est obligatoire',
            'etudiant_id.exists' => 'L\'id de l\'étudiant n\'existe pas',
            'evaluation_id.required' => 'L\'id de l\'évaluation est obligatoire',
            'evaluation_id.exists' => 'L\'id de l\'évaluation n\'existe pas',
            'examen_id.required' => 'L\'id de l\'examen est obligatoire',
            'examen_id.exists' => 'L\'id de l\'examen n\'existe pas',
            'message.required' => 'Le message est obligatoire',
            'message.string' => 'Le message doit être une chaîne de caractères',
            'file.file' => 'Le fichier doit être un fichier',
            'status.required' => 'Le status est obligatoire',
            'status.string' => 'Le status doit être une chaîne de caractères',
            'date.required' => 'La date est obligatoire',
            'date.date' => 'La date doit être une date',
            'objet.required' => 'L\'objet est obligatoire',
            'objet.string' => 'L\'objet doit être une chaîne de caractères',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'etudiant_id' => (int)$this->etudiant_id,
            'evaluation_id' => (int)$this->evaluation_id,
            'examen_id' => (int)$this->examen_id,
            'is_exam' => $this->has('examen_id') ? 1 : 0,
            'date' => date('Y-m-d', strtotime($this->date)),
            'status' => 'pending',
        ]);
    }
}
