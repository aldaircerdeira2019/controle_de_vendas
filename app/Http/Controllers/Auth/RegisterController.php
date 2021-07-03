<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'         => [ 'required'],
            'email'        => [ 'required', 'email', 'unique:users'],
            'password'     => [ 'required', 'min:6', 'max:10', 'confirmed'],
        ]);

        $sql = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);
    }
}
