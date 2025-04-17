<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'       => ['required', 'string', 'max:255'],
            'apellidos'  => ['required', 'string', 'max:255'],
            'email'      => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[^@]+@[^@]+\.[^@]+$/'
            ],
            'telefono'   => ['required', 'regex:/^[0-9]{9}$/'],
            'dni'        => ['required', 'regex:/^[0-9]{8}[A-Za-z]$/', 'unique:users'],
            'pasaporte'  => ['required', 'regex:/^[A-Za-z]{3}[0-9]{6}$/', 'unique:users'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.regex'      => 'El email debe contener un "@" y al menos un punto después.',
            'telefono.regex'   => 'El teléfono debe tener exactamente 9 dígitos.',
            'dni.regex'        => 'El DNI debe tener 8 números seguidos de una letra.',
            'pasaporte.regex'  => 'El pasaporte debe tener 3 letras seguidas de 6 números.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'      => $data['name'],
            'apellidos' => $data['apellidos'],
            'email'     => $data['email'],
            'telefono'  => $data['telefono'],
            'dni'       => $data['dni'],
            'pasaporte' => $data['pasaporte'],
            'password'  => Hash::make($data['password']),
            'rol'       => 'Cliente',
            'creditos' => 1500.00,
        ]);
    }
}
