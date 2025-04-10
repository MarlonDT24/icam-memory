<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupElectroRequest extends FormRequest
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
            'name' => 'required|min:3',
            'author' => 'required',
            'budget_excel' => $this->isMethod('post') ? 'required|file|mimes:xls,xlsx' : 'nullable|file|xls,xlsx',
            'holder' => 'required',
            'address' => 'required|min:5',
            'cod_address' => 'required|min:5',
            'cif' => 'required|min:9|max:20',
            'name_agent' => 'required',
            'nif' => 'required|min:9|max:20',
            'location' => 'required|min:5',
            'cod_location' => 'required|min:5',
            'name_location' => 'required|min:5',
            'build' => 'required|min:3',
            'kva' => 'required|numeric|min:0',
            'kw' => 'required|numeric|min:0',
            'tension_type' => 'required',
            'budget' => 'required|numeric|min:0',
            'type_clasi' => 'required',
            'mark' => 'required|min:3',
            'model' => 'required|min:3',
            'image_model' => 'required',
            'image_dimensions' => 'required',
            'voltage' => 'required',
            'air_entry' => 'required|numeric|min:0',
            'air_flow' => 'required|numeric|min:0',
            'w' => 'required|numeric|min:0',
            'factor' => 'required|numeric|min:0',
            'method' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El Nombre de la Memoria es obligatorio',
            'name.min' => 'El Nombre de la Memoria debe tener al menos 3 carácteres',

            'author.required' => 'El Autor de la Memoria es obligatorio',
            
            'budget_excel' => 'El Excel es obligatorio',

            'holder.required' => 'El Nombre del Titular es obligatorio',

            'address.required' => 'La Dirección Fiscal es obligatoria',
            'address.min' => 'La Dirección Fiscal debe tener al menos 5 carácteres',

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
            'location.min' => 'La Dirección del Emplazamiento debe tener al menos 5 carácteres', 

            'cod_location.required' => 'El Código Postal del Emplazamiento es obligatoria',
            'cod_location.min' => 'El Código Postal del Emplazamiento debe tener al menos 5 carácteres',
            
            'name_location.required' => 'La Localidad del Emplazamiento es obligatoria',
            'name_location.min' => 'La Localidad del Emplazamiento debe tener al menos 5 carácteres', 

            'build.required' => 'El Tipo de Local es obligatorio',
            'build.min' => 'El Tipo de Local debe tener al menos 3 carácteres',
            
            'kva.required' => 'La Potencia Instalada en KVA es obligatoria',
            'kva.numeric' => 'La Potencia Instalada en KVA debe ser un número',

            'kw.required' => 'La Potencia Instalada en KW es obligatoria',
            'kw.numeric' => 'La Potencia Instalada en KW debe ser un número',
            
            'tension_type.required' => 'La Tensión Simple y Compuesta es obligatoria',
            
            'budget.required' => 'El Presupuesto Total es obligatorio',
            'budget.numeric' => 'El Presupuesto Total debe ser un número',
            
            'mark.required' => 'La Marca es obligatoria',
            'mark.min' => 'La Marca debe tener al menos 3 carácteres',

            'model.required' => 'El Modelo es obligatorio',
            'model.min' => 'El Modelo debe tener al menos 3 carácteres',

            'image_model.required' => 'La Imagen del Modelo es obligatoria',

            'image_dimensions.required' => 'La Imagen de las Dimensiones es obligatoria',

            'voltage.required' => 'La Tensión de Servicio es obligatoria', 

            'air_entry.required' => 'La Entrada de Aire en m3/h es obligatoria',
            'air_entry.numeric' => 'La Entrada de Aire en m3/h debe ser un número',

            'air_flow.required' => 'La Entrada de Flujo en m3/minuto es obligatoria',
            'air_flow.numeric' => 'La Entrada de Flujo en m3/minuto debe ser un número',

            'w.required' => 'La Potencia en W es obligatoria',
            'w.numeric' => 'La Potencia en W debe ser un número',

            'factor.required' => 'El Factor de Potencia es obligatorio',
            'factor.numeric' => 'El Factor de Potencia debe ser un número',

            'method.required' => 'El Método de Refrigeración es obligatorio',
        ];
    }
}
