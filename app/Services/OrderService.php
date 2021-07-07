<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use App\Models\Produto;
use App\Models\Venda;


class OrderService
{
    public function createOrder(array $request){
        $user = Auth::user();
        $cliente = $user->cliente;
        $produto = Produto::find($request['produto_id']);
        $empresa = $produto->empresa;
        $quantidade = (int) $request['quantidade'];
        $estoque = (int) $produto->quantidade;

        if($quantidade > $estoque){
            abort(422, "estoque insuficiente para a quantidade, atualize a pagina");
        }

        $valor_unitatio = (float) $produto->valor;
        $valor_total = $valor_unitatio * (float) $quantidade;
        $saldoCliente = (float) $cliente->saldo;

        if($valor_total > $saldoCliente){
            abort(422, "você não possui saldo suficiente para processar a compra");
        }

        $venda = Venda::create([
            "valor_unitatio"    => $valor_unitatio,
            "valor_total"       => $valor_total,
            "quantidade"        => (int) $quantidade,
            "empresa_id"        => $empresa->id,
            "produto_id"        => $produto->id,
            "cliente_id"        => $cliente->id,
        ]);

        $cliente->update([
            "saldo" => $saldoCliente - $valor_total,
        ]);

        $produto->update([
            "quantidade" => $estoque - (int) $quantidade,
        ]);

        return $venda;
    }
}
