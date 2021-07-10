<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venda;

class RelatorioController extends Controller
{
    public function index(Request $request, Venda $venda){
        $this->authorize('admin_view');
        $relatorio = $venda->filter($request->all());
        return response()->json($relatorio);
    }
}
