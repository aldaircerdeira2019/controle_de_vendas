<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use App\Models\User;


class ClienteService
{
    public function createCliente(array $request){
        $user = Auth::user();
        $cliente = $user->cliente;
        if($cliente){
            abort(422, "já exite um cliente vinculado ao usuario");
        }
        $request['user_id'] = $user->id;
        $request['saldo'] = 1000;
        $cliente = Cliente::create($request);
        $user->update([
            'name' => $request['nome'],
            'email' => $request['email']
        ]);

        return $cliente;
    }
}
