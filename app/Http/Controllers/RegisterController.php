<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Http\Request\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show()
    {
        if(Auth::check())
        {
            return redirect()->to('/home');
        }
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = Usuarios::create($request->validated());
        return redirect()->to('/login')->with('success', '¡Se ha creado el usuario correctamente!');
    }

}
