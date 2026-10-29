<?php

namespace App\Http\Requests\Api;

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
                'name_siswa' => 'required|string|max:225',
                'nilai' => 'required|integer|min:0|max:100',
            ];
        }
        return [
            'name_siswa' => 'sometimes|required|string|max:225',
            'nilai' => 'sometimes|required|integer|min:0|max:100',
        ];
    }
    public function messages()
    {
        return [
            'name_siswa.required' => 'Nama siswa wajib diisi.',
            'name_siswa.string' => 'Nama siswa harus berupa teks.',
            'name_siswa.max' => 'Nama siswa maksimal 255 karakter.',
            'nilai.required' => 'Nilai wajib diisi.',
            'nilai.integer' => 'Nilai harus berupa bilangan bulat.',
            'nilai.min' => 'Nilai minimal 0.',
            'nilai.max' => 'Nilai maksimal 100.',
        ];
    }
}
