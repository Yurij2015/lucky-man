<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlayerSaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => [
                'required',
                Rule::unique('players', 'username')->ignore($this->player),
                'max:25'
            ],
            'phone' => [
                'required',
                Rule::unique('players', 'phone')->ignore($this->player),
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:10',
                'max:25'
            ],
        ];
    }
}
