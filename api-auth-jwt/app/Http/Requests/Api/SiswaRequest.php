<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('POST')) {
            return [
                'name_siswa' => [
                    'required',
                    'string',
                    'max:225',
                ],
                'nilai' => [
                    'required',
                    'integer',
                    'min:0',
                    'max:100',
                ],
            ];
        }

        return [
            'name_siswa' => [
                'sometimes',
                'required',
                'string',
                'max:225',
            ],
            'nilai' => [
                'sometimes',
                'required',
                'integer',
                'min:0',
                'max:100',
            ],
        ];
    }
}
