<?php

namespace App\Http\Requests;

use App\Models\AnneeScolaire;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFiliereRequest extends FormRequest
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
            'id' => 'required|integer|exists:filieres,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'id.required' => 'L\'identifiant de la filière est obligatoire',
            'id.integer' => 'L\'identifiant de la filière doit être un entier',
            'id.exists' => 'La filière n\'existe pas',
            'name.required' => 'Le nom de la filière est obligatoire',
            'name.string' => 'Le nom de la filière doit être une chaîne de caractères',
            'name.max' => 'Le nom de la filière ne peut pas dépasser 255 caractères',
            'description.required' => 'La description de la filière est obligatoire',
            'description.string' => 'La description de la filière doit être une chaîne de caractères',
            'description.max' => 'La description de la filière ne peut pas dépasser 255 caractères',
            'status.required' => 'Le status de la filière est obligatoire',
            'status.boolean' => 'Le status de la filière doit être un booléen',
            'image.required' => 'L\'image de la filière est obligatoire',
            'image.image' => 'L\'image de la filière doit être une image',
            'image.mimes' => 'L\'image de la filière doit être de type jpeg, png, jpg, gif, svg',
            'image.max' => 'L\'image de la filière ne peut pas dépasser 2048 kilo-octets',
        ];
    }



    public function prepareForValidation()
    {
        $this->merge([
            'annee_scolaire' => AnneeScolaire::valideYear(),
        ]);
    }


    

}
