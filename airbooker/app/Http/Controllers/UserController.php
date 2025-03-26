<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::paginate(10); // ✅ Usar paginate() en lugar de all()
    
            return view('admin.users', compact('users'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|unique:users,dni',
            'pasaporte' => 'required|unique:users,pasaporte',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'required|string|max:20',
            'rol' => 'required|in:Administrador,Cliente',
            'password' => 'required|min:6|confirmed',
        ]);

        // Creación del nuevo usuario
        $user = new User();
        $user->name = $request->input('name');
        $user->apellidos = $request->input('apellidos');
        $user->dni = $request->input('dni');
        $user->pasaporte = $request->input('pasaporte');
        $user->email = $request->input('email');
        $user->email_verified_at = now(); // Marca la verificación del email
        $user->telefono = $request->input('telefono');
        $user->rol = $request->input('rol');
        $user->password = Hash::make($request->input('password')); // Encriptación de la contraseña
        $user->remember_token = Str::random(10); // Token para recordar al usuario
        $user->save();

        // Redirigir a la página de usuarios con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //Muestra la vista de perfil con los datos del usuario con el ID suministrado
        return view('perfil', ['usuario' => User::findorFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // Buscar el usuario por su ID
        return response()->json($user);    
    }

    /**
     * Update the specified resource in storage.
     */
    // Método para actualizar el usuario
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|unique:users,dni,' . $id . ',id|max:9', 
            'pasaporte' => 'required|unique:users,pasaporte,' . $id . ',id|max:9', 
            'email' => 'required|email|unique:users,email,' . $id . ',id|max:255', 
            'telefono' => 'required|string|max:25',
            'rol' => 'required|in:Administrador,Cliente',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Buscar el usuario en la base de datos
        $user = User::findOrFail($id);

        // Actualizar los datos del usuario
        $user->name = $request->input('name');
        $user->apellidos = $request->input('apellidos');
        $user->dni = $request->input('dni');
        $user->pasaporte = $request->input('pasaporte');
        $user->email = $request->input('email');
        $user->telefono = $request->input('telefono');
        $user->rol = $request->input('rol');
        
        // Si se proporciona una nueva contraseña, encriptarla y actualizarla
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save(); // Guardar los cambios en la base de datos

        // Redirigir de vuelta con un mensaje de éxito
        return back()->with('success', 'Usuario actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($id);
    
            // Delete the user
            $user->delete();
    
            // Redirect to the user list with success message
            return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente');
        } catch (\Exception $e) {
            // Handle exception if user is not found or any other error occurs
            return redirect()->route('users.index')->with('error', 'Error al eliminar el usuario');
        }
    }
 
}

