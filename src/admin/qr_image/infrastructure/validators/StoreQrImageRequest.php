<?php

namespace Src\admin\qr_image\infrastructure\validators;

use Illuminate\Foundation\Http\FormRequest;

class StoreQrImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'description' => 'required|min:3|max:250',
            'valid_from' => 'required|date|date_format:Y-m-d',
            'expired' => 'required|date|date_format:Y-m-d|after:valid_from',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'amount' => 'required|numeric|min:0',
        ];
    }
}