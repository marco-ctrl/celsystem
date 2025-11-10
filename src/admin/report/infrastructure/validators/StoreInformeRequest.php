<?php

namespace Src\admin\report\infrastructure\validators;

use Illuminate\Foundation\Http\FormRequest;

class StoreInformeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Cambia esto según tus necesidades de autorización
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'asistencia' => 'required|array',
            'asistencia.*.id' => 'nullable',
            'asistencia.*.name' => 'required|string|max:50',
            'asistencia.*.lastname' => 'required|string|max:50',
            'asistencia.*.contact' => 'nullable|string|max:11',
            'asistencia.*.tipe' => 'required|integer',
            'asistencia.*.celula_id' => 'required|integer',
            'asistencia.*.status' => 'required|integer',
            
            'celula_id' => 'required|integer',
            'offering' => 'required|numeric|min:0',
            'payment_method' => 'required|in:0,1',
            'photo' => 'required|file|image|max:1024',
            'voucher' => 'nullable|file|image|max:1024',
            'addres' => 'required|max:250',
            
            'visita' => 'required|array',
            'visita.*.id' => 'nullable',
            'visita.*.name' => 'required|string|max:50',
            'visita.*.lastname' => 'required|string|max:50',
            'visita.*.contact' => 'nullable|string|max:11',
            'visita.*.tipe' => 'required|integer',
            'visita.*.celula_id' => 'required|integer',
            'visita.*.status' => 'required|integer',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'asistencia.name.required' => 'El nombre del asistente es obligatorio.',
            'asistencia.lastname.required' => 'El apellido del asistente es obligatorio.',
            // Add other custom messages as needed
        ];
    }
}
