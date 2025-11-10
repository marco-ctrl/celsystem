<?php

namespace Src\admin\celula\infrastructure\validators;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCelulaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $celula = $this->route()->parameter('celula');
        return [
            'number' => "required|integer|min:1|unique:celulas,number,{$celula->id},id",
            'name' => 'required|min:3|max:50',
            'addres' => 'required|min:3|max:250',
            'day' => 'required|in:1,2,3,4,5,6,7',
            'hour' => 'required|date_format:H:i',
            'latitude' => 'required|numeric',
            'length' => 'required|numeric',
            'lider_id' => "required|exists:liders,id|unique:celulas,lider_id,{$celula->id},id",
            'tipe' => 'required|in:1,2,3'
        ];
    }
}
