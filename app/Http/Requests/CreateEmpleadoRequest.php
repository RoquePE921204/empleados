<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Validator;

class CreateEmpleadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Validator::extend('is_valid_skills',function ($attribute, $value, $parameters)
        {
            $result = false;
            if (is_array($value)) {
                if (count($value) > 0) {
                    $total = count($value);
                    $validos = 0;
                    foreach ($value as $key => $skill) {
                        if (is_array($skill)) {
                            if (array_key_exists('nombre', $skill) && array_key_exists('calificacion', $skill)) {
                                $validos = $validos + (($skill['nombre'] != '' && $skill['calificacion'] != '' && intval($skill['calificacion']) > 0 && intval($skill['calificacion']) <= 5) ? 1 : 0);
                            }else{
                                break;
                            }
                        }else{
                            break;
                        }
                    }
                    $result = $total == $validos;
                }
            }
            return $result;
        });
        return [
            'nombre' => 'required',
            'email' => 'required|unique:empleados,email',
            'puesto' => 'required',
            'domicilio' => 'required',
            'fecha_nacimiento' => 'required|date',
            'skills' => 'is_valid_skills'
        ];
    }

    public function messages()
    {
        return [
            'skills.is_valid_skills' => 'Incomplete skills'
        ];
    }
}
