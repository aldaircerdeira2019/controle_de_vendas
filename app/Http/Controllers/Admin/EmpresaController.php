<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;
use App\Services\EmpresaService;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin_view')->only('index');
        $this->middleware('can:admin_create')->only('store');
        $this->middleware('can:admin_edit')->only('update');
        $this->middleware('can:admin_del')->only('destroy');
    }

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

    public function destroy($id){
        $empresa = Empresa::find($id);
        $empresa->delete();
        return 'ok';
    }
}
