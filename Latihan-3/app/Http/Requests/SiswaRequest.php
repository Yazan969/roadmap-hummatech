<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        if ($this->isMethod('POST')) {
            return [
                'nama' => 'required|string|max:255',
                'nilai' => 'required|integer|min:0|max:100',
            ];
        }
        return [
            'nama' => 'sometimes|required|string|max:255',
            'nilai' => 'sometimes|required|integer|min:0|max:100',
        ];
    }
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nilai.required' => 'Nilai wajib diisi.',
            'nilai.integer' => 'Nilai harus berupa bilangan bulat.',
            'nilai.min' => 'Nilai minimal 0.',
            'nilai.max' => 'Nilai maksimal 100.',
        ];
    }
}
