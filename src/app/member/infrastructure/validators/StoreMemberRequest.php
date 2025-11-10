<?php

namespace Src\app\member\infrastructure\validators;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
                'name' => 'required|min:3|max:50',
                'lastname' => 'required|min:3|max:50',
                'contact' => 'nullable|string|regex:/^[0-9]{7,10}$/|max:11|min:3',
                'tipe' => 'required|in:0,1,2,3',
        ];
    }
}
