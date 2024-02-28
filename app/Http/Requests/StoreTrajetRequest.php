<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrajetRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:trajets',
            'slug' => 'required|string|unique:trajets,slug',
            'waypoints' => 'required|array',
            'city_departure_time' => 'required|date_format:H:i',
            'school_departure_time' => 'required|date_format:H:i',
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
            'name.required' => 'Le nom est obligatoire',
            'slug.required' => 'Le slug est obligatoire',
            'slug.unique' => 'Le slug doit être unique',
            'waypoints.required' => 'Les points de passage sont obligatoires',
            'city_departure_time.required' => 'L\'heure de départ de la ville est obligatoire',
            'school_departure_time.required' => 'L\'heure de départ de l\'école est obligatoire',
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
            'name' => 'Nom',
            'slug' => 'Slug',
            'waypoints' => 'Points de passage',
            'city_departure_time' => 'Heure de départ de la ville',
            'school_departure_time' => 'Heure de départ de l\'école',
        ];
    }


    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => \Str::slug($this->name . '-' . \Str::random(6) . '-' . \Str::random(6))
        ]);
    }
}
