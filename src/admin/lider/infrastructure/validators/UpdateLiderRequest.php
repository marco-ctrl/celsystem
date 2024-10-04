<?php

namespace Src\admin\lider\infrastructure\validators;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLiderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $lider = $this->route()->parameter('lider');
        return [
            'name' => 'required|max:50',
            'lastname' => 'required|max:50',
            'birthdate' => 'required|date',
            'addres' => 'required|max:150',
            'contact' => 'required|max:11',
            'foto' => 'nullable',
            'email' => "required|email|unique:users,email,{$lider->user_id},id"
        ];
    }
}
