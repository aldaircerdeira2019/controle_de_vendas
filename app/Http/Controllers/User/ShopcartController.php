<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Services\OrderService;

class ShopcartController extends Controller
{
    public function findOneProduto($id){
        $produto = Produto::find($id);
        return response()->json($produto);
    }

    public function createOrder(Request $request){
        $orderService = new OrderService();
        $order = $orderService->createOrder($request->all());
        return response()->json($order);
    }
}
