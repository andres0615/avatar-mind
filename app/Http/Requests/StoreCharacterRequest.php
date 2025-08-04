<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCharacterRequest extends FormRequest
{
    // protected $stopOnFirstFailure = false;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check(); // Verifica que el usuario esté autenticado
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'required|in:Anime,Videojuegos,Películas,Libros,Comic,Histórico,Original',
            'tagline' => 'required|string|max:100',
            'visibility' => 'nullable|in:public,private,friends',
            'personality_description' => 'nullable|string|max:2000',
            'age' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:255',
            'interests' => 'nullable|array|max:20', // Máximo 20 intereses
            'interests.*' => 'string|max:100|distinct', // Cada interés único
            'creativity_level' => 'required|integer|min:1|max:10',
            'response_length' => 'required|in:short,medium,long',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del personaje es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'category.required' => 'La categoría es obligatoria.',
            'category.in' => 'La categoría debe ser una de: Anime, Videojuegos, Películas, Libros, Histórico, Original.',
            'tagline.required' => 'La descripción corta es obligatoria.',
            'tagline.max' => 'La descripción corta no puede tener más de 100 caracteres.',
            'visibility.in' => 'La visibilidad debe ser: public, private o friends.',
            'personality_description.max' => 'La descripción de personalidad no puede tener más de 2000 caracteres.',
            'age.max' => 'La edad no puede tener más de 50 caracteres.',
            'occupation.max' => 'La ocupación no puede tener más de 255 caracteres.',
            'interests.max' => 'No puedes agregar más de 20 intereses.',
            'interests.*.max' => 'Cada interés no puede tener más de 100 caracteres.',
            'interests.*.distinct' => 'No puedes repetir intereses.',
            'creativity_level.min' => 'El nivel de creatividad debe ser entre 1 y 10.',
            'creativity_level.max' => 'El nivel de creatividad debe ser entre 1 y 10.',
            'response_length.in' => 'La longitud de respuesta debe ser: short, medium o long.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Limpiar y preparar datos antes de validar
        $this->merge([
            'name' => trim($this->name),
            'tagline' => $this->tagline ? trim($this->tagline) : null,
            'personality_description' => $this->personality_description ? trim($this->personality_description) : null,
            'age' => $this->age ? trim($this->age) : null,
            'occupation' => $this->occupation ? trim($this->occupation) : null,
            'interests' => $this->interests ? array_map('trim', $this->interests) : null,
        ]);
    }
}