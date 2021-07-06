<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    public function search(array $request){

        $result = $this
        ->where(function ($query) use($request){
            if(isset($request['search']))
            {
                $query->Where('nome', 'LIKE', '%'.$request['search'].'%');
            }
            if(isset($request['empresa_id']))
            {
                $query->Where('empresa_id', $request['empresa_id']);
            }
        })

        ->with('empresa')
        ->orderBy('id', 'desc')
        ->paginate(20);
        return $result;
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
