<?php

namespace Src\admin\weekly_lesson\infrastructure\validators;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required|mimes:pdf|max:40240',
            'tema' => 'required|string|min:3|max:225',
            'description' => 'required|string|min:3|max:225',
        ];
    }
}
