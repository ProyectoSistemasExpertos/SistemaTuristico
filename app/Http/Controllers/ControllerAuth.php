<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PasswordResetToken;
use App\Http\Controllers\ControllerMail;
use App\Models\Person;
use App\Models\Preferences;

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
        $user = $request->all();
        $person = new Person();
        $idRol = $request->has('idRol') ? 1 : 2;
        $person = new Person();
        $person->idCard = $user['idCard'];
        $person->name = $user['name'];
        $person->firstLastName = $user['firstLastName'];
        $person->secondLastName = $user['secondLastName'];
        $person->phone = $user['phone'];
        $person->address = $user['address'];
        $person->email = $user['email'];
        $person->password = Hash::make($user['password']);
        $person->idRol = $idRol;

        $person->save();
        $user = Person::where('idCard', $request->idCard)->firstOrFail();
        $idCategory = $request->input('idCategory');

        $preference = Preferences::create([
            'idPerson' => $user->id,
            'idCategory' => $idCategory,
        ]);

        return redirect()->route('home')->with('success', '¡Registro exitoso! Bienvenido a nuestro sitio.');
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

            //return response()->json(['message' => 'Inicio de sesión exitoso', 'user' => $user, 'access_token' => $token], 200);
            return redirect()->route('booking.index')->with(201);
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

    // Elimina tokens antiguos para el mismo usuario
    PasswordResetToken::where('email', $user->email)->delete();

    $resetToken = PasswordResetToken::create([
        'email' => $user->email,
        'token' => bin2hex(random_bytes(32)), // Genera un token aleatorio
    ]);
    printf('Usuario: '.$resetToken);
    $mailController = new ControllerMail();
    $mailController->sendResetPasswordEmail($user->email, $resetToken->token);
    return view('auth.login');
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

    // Validate the token
    $passwordResetToken = $user->passwordResetTokens()->first();

    if (!$passwordResetToken) {
        return response()->json(['error' => 'Token no encontrado'], 404);
    }
    
    $isValidToken = $this->validateResetToken($passwordResetToken, $request->token);

    if (!$isValidToken) {
        return response()->json(['error' => 'Token no válido'], 400);
    }

    // Update the password

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    // Delete the password reset token
    PasswordResetToken::where('email', $user->email)->delete();

    return response()->json(['message' => 'Contraseña restablecida exitosamente'], 200);
}

public function validateResetToken($passwordResetToken, $token)
{
    // Get all access tokens of the user
    $userToken = $passwordResetToken->token;
    // Validate if the reset token is valid
    return hash_equals(strval($userToken), strval($token));
}
    public function showHome()
    {
        return view('auth.login');
    }
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function showResetPasswordForm(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
        }

}
