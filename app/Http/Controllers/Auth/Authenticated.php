<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticated extends Controller
{
    public function index(){
        $user = Auth::user();
        $permissions = $user->getAllPermissions();
        $data = [
            "id" => $user->id,
            "name" => $user->name,
            "permissions" => $permissions,
        ];

        return response()->json($data);
    }
}
