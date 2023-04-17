<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerSaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|max:25',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:25',
        ];
    }
}
