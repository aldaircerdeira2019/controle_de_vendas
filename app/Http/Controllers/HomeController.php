<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Empresa;

class HomeController extends Controller
{
    public function index(Produto $produto, Request $request){
        $produtos = $produto->search($request->all());
        return response()->json($produtos);
    }

    public function getAllEmpresas(){
        $empresas = Empresa::all();
        return response()->json($empresas);
    }
}
