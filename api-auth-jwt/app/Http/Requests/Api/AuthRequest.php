<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->is('api/register')) {
            return [
                'username' => [
                    'required',
                    'string',
                    'min:3',
                    'max:30',
                    'alpha_dash',
                    'unique:users,username',
                ],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:users,email',
                ],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                ],
            ];
        }

        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
