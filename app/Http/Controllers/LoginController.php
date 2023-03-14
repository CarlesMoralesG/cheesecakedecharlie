<?php

namespace App\Http\Controllers;

use App\Http\Request\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        if(Auth::check())
        {
            if ( auth()->user()->Rol == 1)
            {
                return redirect()->to('/adminPedidos');
            }
            else
            {
                return redirect()->to('/home');
            }
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {    
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials))
        {
            return redirect()->to('/login')->withErrors('Usuario o Contraseña incorrectos');
        }
        
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        if ( auth()->user()->Rol == 1)
        {
            return redirect()->to('/adminPedidos');
        }
        else
        {
            return redirect()->to('/home');
        }
    }
}
