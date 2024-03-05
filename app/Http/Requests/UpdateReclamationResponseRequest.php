<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReclamationResponseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isProfesseur();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reclamantion_id' => 'required|exists:reclamantions,id',
            'message' => 'required|string',
            'piece_jointe' => 'nullable|file',
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
            'reclamantion_id.required' => 'L\'id de la réclamation est obligatoire',
            'reclamantion_id.exists' => 'L\'id de la réclamation n\'existe pas',
            'message.required' => 'Le message est obligatoire',
            'message.string' => 'Le message doit être une chaîne de caractères',
            'piece_jointe.file' => 'La pièce jointe doit être un fichier',
        ];
    }


    public function prepareForValidation()
    {
        $this->merge([
            'reclamantion_id' => (int)$this->reclamantion_id,
            'date' => now(),
        ]);
    }

}
