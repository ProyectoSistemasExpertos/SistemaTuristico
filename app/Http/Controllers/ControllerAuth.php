<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ControllerAuth extends Controller
{
    public function register(Request $request)
    {
        // Validación de datos
        $request->validate([
            'name' => 'required|string',
            'idCard' => 'required|integer',
            'firstLastName' => 'required|string',
            'secondLastName' => 'required|string',
            'phone' => 'required|integer',
            'address' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'idCard' => $request->idCard,
            'firstLastName' => $request->firstLastName,
            'secondLastName' => $request->secondLastName,
            'phone' => $request->phone,
            'address' => $request->address,
            'rol' => 1,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return response()->json(['message' => 'Registro exitoso', 'user' => $user], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->has('remember') ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = User::where('email', $request->email)->firstOrFail();

            $token = $user->createToken('access_token')->plainTextToken;

            return response()->json(['message' => 'Inicio de sesión exitoso', 'user' => $user, 'access_token' => $token], 200);
        } else {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Cierre de sesión exitoso'], 200);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'Correo electrónico no encontrado'], 404);
        }

        $resetToken = $this->generateResetToken($user);

        // Envía el correo de recuperación de contraseña
        Mail::to($user->email)->send(new ResetPasswordMail($resetToken));

        return response()->json(['message' => 'Correo de recuperación enviado exitosamente'], 200);
    }

    private function generateResetToken(User $user)
    {
        $token = sha1(time() . $user->email . $user->password);

        // Guarda el token en la base de datos o en una tabla específica para restablecimiento de contraseña
        // Esto puede depender de tu implementación específica

        // Ejemplo:
        // $user->update(['reset_token' => $token]);

        return $token;
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'token' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'Correo electrónico no encontrado'], 404);
        }

        // Validar el token (puedes tener una lógica específica aquí)
        $isValidToken = $this->validateResetToken($user, $request->token);

        if (!$isValidToken) {
            return response()->json(['error' => 'Token no válido'], 400);
        }

        // Actualizar la contraseña
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Eliminar el token de restablecimiento de contraseña
        // Esto puede depender de tu implementación específica

        // Ejemplo:
        // $user->update(['reset_token' => null]);

        return response()->json(['message' => 'Contraseña restablecida exitosamente'], 200);
    }

    private function validateResetToken(User $user, $token)
    {
        // Obtener todos los tokens de acceso del usuario
        $userTokens = $user->tokens;
    
        // Validar si el token de restablecimiento es válido
        $isValidToken = $userTokens->contains(function ($userToken) use ($token) {
            // Puedes comparar el token almacenado con el token proporcionado
            // Aquí necesitarás ajustar según cómo almacenes y compares tus tokens
    
            // Ejemplo: Comparar solo el valor del token
            return hash_equals($userToken->id, $token);
        });
    
        return $isValidToken;
    }
    

}
