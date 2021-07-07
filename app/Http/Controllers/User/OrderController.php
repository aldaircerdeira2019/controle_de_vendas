<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class OrderController extends Controller
{
    public function findAllOrderByClient ($client_id){
        $orders = Cliente::find($client_id)->vendas->load('produto', 'empresa');
        return response()->json($orders);

    }
}
