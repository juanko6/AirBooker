<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Asegúrate de que solo los usuarios no autenticados puedan acceder al formulario de inicio de sesión
        $this->middleware('guest')->except('logout');
    }

    /**
     * Método para mostrar el formulario de inicio de sesión.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Retorna la vista de inicio de sesión
    }

    /**
     * Método para manejar el inicio de sesión.
     */
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $credentials = $request->validate([
            'email' => ['required', 'email'], // El email es obligatorio y debe ser un formato válido
            'password' => ['required', 'min:6'], // La contraseña es obligatoria y debe tener al menos 6 caracteres
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Regenerar la sesión para prevenir ataques de fixation
            $request->session()->regenerate();

            // Redirigir al usuario a la página deseada después del inicio de sesión
            return redirect()->intended($this->redirectTo);
        }

        // Si las credenciales son incorrectas, redirigir con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Método para cerrar la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidar la sesión actual y regenerar el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigir al usuario a la página de inicio
        return redirect()->route('home');
    }
}