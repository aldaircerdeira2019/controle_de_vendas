<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|min:10|max:60',
            'cnpj' => 'required|min:18|unique:empresas',
            'cep' => 'required|min:9',
            'razao_social' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'password'=> 'required|min:6|max:10|confirmed',
        ];
    }
}
