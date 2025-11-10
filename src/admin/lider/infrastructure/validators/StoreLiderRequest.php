<?php

namespace Src\admin\lider\infrastructure\validators;

use Illuminate\Foundation\Http\FormRequest;

class StoreLiderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'lastname' => 'required|max:50',
            'birthdate' => 'required|date',
            'addres' => 'required|max:150',
            'code' => 'in:+54,+591',
            'contact' => 'required|max:15',
            'foto' => 'nullable',
            'email' => 'required|email|unique:users,email'
        ];
    }
}
