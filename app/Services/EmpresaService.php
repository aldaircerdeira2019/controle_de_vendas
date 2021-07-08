<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;
use App\Models\User;
use App\Models\EmpresaHasUser;

class EmpresaService
{
    public function createEmpresa(array $request){
        $user = User::create([
            'name' => $request['nome'],
            'email' => $request['email'],
            'password' => $request['password'],
        ]);

        $empresa = Empresa::create($request);

        $EmpresaUser = EmpresaHasUser::create([
            'user_id' => $user->id,
            'empresa_id' => $empresa->id,
        ]);

        return $empresa;
    }
}
