<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor_unitatio',
        'valor_total',
        'quantidade',
        'empresa_id',
        'produto_id',
        'cliente_id',
    ];

    public function filter(array $request){

        $result = $this
        ->where(function ($query) use($request){
            if(isset($request['empresa_id']))
            {
                $query->Where('empresa_id', $request['empresa_id']);
            }
            if(isset($request['data_inicio']) && isset($request['data_final']))
            {
                $start = $request['data_inicio'];
                $end = $request['data_final'];
                $query->wherebetween('created_at', array($start, $end));
            }
        })
        ->with('cliente','empresa', 'produto')
        ->orderBy('id', 'desc')
        ->get();
        return $result;
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
