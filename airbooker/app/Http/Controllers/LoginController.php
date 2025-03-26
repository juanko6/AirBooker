<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Método para mostrar el formulario de inicio de sesión
    public function showLogin()
    {
        return view('login'); // Retorna la vista de registro
    }

    /*public function login(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|email',
            'password'=> 'required|min:6',
            ]);
            $user = User::where('email',$request->email)->first();
            if ($user) {
                $user->password = bcrypt($request->password);
                $user->save();
                return redirect()->route('home');

            } else {
                return back()->with('error', 'Usuario no encontrado');            
            }
    }

    public function validate(Request $request)
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    }
    */
}
