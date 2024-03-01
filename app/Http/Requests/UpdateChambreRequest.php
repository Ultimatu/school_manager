<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChambreRequest extends FormRequest
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
            'id'=> 'required|exists:chambres,id',
            'number' => 'required|string|max:255|unique:chambres,number',
            'type' => 'required|string|max:255',
            'status' => 'required|string',
            'cite_id' => 'required|exists:cites,id',
            'is_occupied' => 'required|boolean',
            'location' => 'required|string',
            'capacity' => 'required|integer',
            'slug' => 'required|string|unique:chambres,slug',
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
            'id.required' => 'L\'id de la chambre est requis',
            'number.required' => 'Le numéro de la chambre est obligatoire',
            'type.required' => 'Le type de la chambre est obligatoire',
            'status.required' => 'Le statut de la chambre est obligatoire',
            'cite_id.required' => 'La cite de la chambre est obligatoire',
            'is_occupied.required' => 'Le champ is_occupied est obligatoire',
            'location.required' => 'L\'emplacement de la chambre est obligatoire',
            'capacity.required' => 'La capacité de la chambre est obligatoire',
            'slug.required' => 'Le slug de la chambre est obligatoire',
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
            'number' => 'Numéro',
            'type' => 'Type',
            'status' => 'Statut',
            'cite_id' => 'Cité',
            'is_occupied' => 'Occupé',
            'location' => 'Emplacement',
            'capacity' => 'Capacité',
            'slug' => 'Slug'
        ];
    }


    //before validation
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => \Str::slug($this->number.'-'.$this->cite_id),
            'is_occupied' => $this->has('is_occupied') ? true : false
        ]);
    }
}
