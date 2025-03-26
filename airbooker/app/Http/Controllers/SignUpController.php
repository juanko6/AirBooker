<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function showSignUp()
    {
        //return view('auth.signup'); // Renderiza el formulario de registro
        return view('signup'); // Retorna la vista de registro
    }

    public function signup(Request $request)
    {
        $user = auth()->user();
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('')->with('success','');
               
    }

  
}