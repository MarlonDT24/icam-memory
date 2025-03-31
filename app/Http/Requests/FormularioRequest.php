<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormularioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:5',
            'holder' => 'required',
            'address' => 'required|min:10',
            'cod_address' => 'required|min:5',
            'cif' => 'required|min:9|max:20',
            'name_agent' => 'required',
            'nif' => 'required|min:9|max:20',
            'location' => 'required|min:10',
            'cod_location' => 'required|min:5',
            'activity' => 'required|min:10',
            'description' => 'required|min:10',
            'm_parcels' => 'required|numeric|min:0',
            'm_surface' => 'required|numeric|min:0',
            'requirements' => 'required|min:10',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El Nombre de la Memoria es obligatorio',
            'name.min' => 'El Nombre de la Memoria debe tener al menos 5 carácteres', 

            'holder.required' => 'El Nombre del Titular es obligatorio',

            'address.required' => 'La Dirección Fiscal es obligatoria',
            'address.min' => 'La Dirección Fiscal debe tener al menos 10 carácteres',

            'cod_address.required' => 'El Codigo Postal es obligatorio',
            'cod_address.min' => 'El Codigo Postal debe tener al menos 5 carácteres',

            'cif.required' => 'El CIF del Titular es obligatorio',
            'cif.min' => 'El CIF del Titular debe tener al menos 9 carácteres',
            'cif.max' => 'El CIF del Titular debe tener como máximo 20 carácteres',

            'name_agent.required' => 'El Nombre del Representante es obligatorio',
            
            'nif.required' => 'El NIF del Representante es obligatorio',
            'nif.min' => 'El NIF del Representante debe tener al menos 9 carácteres',
            'nif.max' => 'El NIF del Representante debe tener como máximo 20 carácteres',

            'location.required' => 'La Dirección del Emplazamiento es obligatoria',
            'location.min' => 'La Dirección del Emplazamiento debe tener al menos 10 carácteres', 

            'cod_location.required' => 'El Código Postal del Emplazamiento es obligatoria',
            'cod_location.min' => 'El Código Postal del Emplazamiento debe tener al menos 5 carácteres', 

            'activity.required' => 'La Actividad a realizar es obligatoria',
            'activity.min' => 'La Actividad a realizar debe tener al menos 10 carácteres',

            'description.required' => 'La Descripción de la Actividad es obligatoria',
            'description.min' => 'La Descripción de la Actividad debe tener al menos 10 carácteres',
            
            'm_parcels.required' => 'Los Metros Cuadrados de la Parcela son obligatorios',
            'm_parcels.numeric' => 'Los Metros Cuadrados de la Parcela deben ser un número',
            
            'm_surface.required' => 'Los Metros Cuadrados de la Superficie Edificada son obligatorios', 
            'm_surface.numeric' => 'Los Metros Cuadrados de la Superficie Edificada deben ser un número',
            
            'requirements.required' => 'Los Requerimientos de la Instalación son obligatorios',
            'requirements.min' => 'Los Requerimientos de la Instalación deben tener al menos 10 carácteres',
        ];
    }
}
