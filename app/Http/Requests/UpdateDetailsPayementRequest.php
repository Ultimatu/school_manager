<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailsPayementRequest extends FormRequest
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
            'id' => 'required|integer|exists:details_payements,id',
            'payment_scolarite_id' => 'required|integer|exists:payment_scolarites,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'observation' => 'nullable|string',
            'mode_payement' => 'required|string',
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
            'id.required' => 'L\'id est obligatoire',
            'id.integer' => 'L\'id doit être un entier',
            'id.exists' => 'L\'id n\'existe pas',
            'payment_scolarite_id.required' => 'L\'id du paiement est obligatoire',
            'payment_scolarite_id.integer' => 'L\'id du paiement doit être un entier',
            'payment_scolarite_id.exists' => 'L\'id du paiement n\'existe pas',
            'amount.required' => 'Le montant est obligatoire',
            'amount.numeric' => 'Le montant doit être un nombre',
            'amount.min' => 'Le montant doit être supérieur à 0',
            'date.required' => 'La date est obligatoire',
            'date.date' => 'La date doit être une date',
            'observation.string' => 'L\'observation doit être une chaîne de caractères',
            'mode_payement.required' => 'Le mode de paiement est obligatoire',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'id'=> 'identifiant',
            'payment_scolarite_id'=> 'identifiant',
            'amount'=> 'montant',
            'date'=> 'date',
            'observation'=> 'observation',
            'mode_payement'=> 'mode de paiement',
        ];
    }
}
