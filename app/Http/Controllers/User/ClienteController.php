<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ClienteService;

class ClienteController extends Controller
{
    public function findOneCliente(){
        $user = Auth::user();
        $cliente = $user->cliente;
        return response()->json($cliente);
    }

    public function findUser(){
        $user = Auth::user();
        return response()->json($user);
    }

    public function store(Request $request){
        $id = Auth::id();
        $request->validate([
            'cpf'         => [ 'required', 'min:14', "unique:clientes"],
            'nome'         => [ 'required', 'max:60'],
            'email'        => [ 'required', 'email', "unique:users,email,{$id},id"],
        ]);
        $clienteService = new ClienteService();
        $cliente = $clienteService->createCliente($request->all());
        return $cliente;
    }

}
