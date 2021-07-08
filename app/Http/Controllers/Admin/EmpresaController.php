<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;
use App\Services\EmpresaService;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    public function index(Request $request){
        $empresas = Empresa::orderBy('id','desc')->get();
        return response()->json($empresas);
    }

    public function store(EmpresaRequest $request) {
        $empresaService = new EmpresaService();
        $empresa = $empresaService->createEmpresa($request->all());
        return $empresa;
    }

    public function update(EmpresaRequest $request, $id){
        $empresa = Empresa::find($id);
        $empresa->update($request->all());
        return $empresa;
    }
}
