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
        $id= $this->segment(4);

        $email = $id !=null ? '':'required';
        $password = $id !=null ? '': 'required';

        return [
            'nome' => 'required|min:10|max:60',
            'cnpj' => "required|min:18|unique:empresas,cnpj,{$id},id",
            'cep' => 'required|min:9',
            'razao_social' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required|min:2',
            'email' => "{$email}|email|unique:users",
            'password'=> "{$password}|min:6|max:10|confirmed",
        ];
    }
}
