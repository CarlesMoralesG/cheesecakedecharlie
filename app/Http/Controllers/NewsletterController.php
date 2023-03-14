<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Auth;

class NewsletterController extends Controller
{
    public function suscribeNewsletter(Request $request)
    {
        $data = $request->only('correoNewsletter');
       
        $request->validate([
            'correoNewsletter' => 'required|unique:Newsletter,correoNewsletter|max:120'
        ]);

        $user = Newsletter::create($data);
        return redirect()->to('/home')->with('success', '¡Gracias por suscribirte a nuestras Newsletter!');
    }
}
