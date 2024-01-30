<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PasswordResetToken;
use App\Http\Controllers\ControllerMail;
use App\Http\Livewire\Notification;
use App\Models\Person;
use App\Models\Preferences;

class ControllerAuth extends Controller
{
    public function register(Request $request)
    {
        try {

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
           event(new Notification('success', '¡Registro exitoso! Bienvenido a nuestro sitio!'));
            return redirect()->route('home')->with('success', '¡Registro exitoso! Bienvenido a nuestro sitio.');
        } catch (\Exception $e) {
           event(new Notification('success', '¡Registro fallido! El correo electrónico ya está registrado.'));
            return redirect()->route('home')->with('success', '¡Registro fallido! El correo electrónico ya está registrado.');
        }
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
           event(new Notification('success', '¡Inicio de sesión exitoso!'));
            //return response()->json(['message' => 'Inicio de sesión exitoso', 'user' => $user, 'access_token' => $token], 200);
            return redirect()->route('booking.index')->with(201);
        } else {
           event(new Notification('success', 'Credenciales inválidas!'));
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
           event(new Notification('success', '¡Cierre de Sesión Exitoso!'));
            return redirect()->route('home')->with('success', 'Bienvenido de nuevo.');
        } catch (\Exception $e) {
           event(new Notification('success', '¡Cierre de Sesión Fallido!'));
            return redirect()->route('home')->with('success', 'Bienvenido de nuevo.');
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            $user = User::where('email', $request->email)->first();
            if (!$user) {
               event(new Notification('success', '¡Correo electrónico no encontrado!'));
                return view('home');
            }
            PasswordResetToken::where('email', $user->email)->delete();
            $resetToken = PasswordResetToken::create([
                'email' => $user->email,
                'token' => bin2hex(random_bytes(32)),
            ]);
            $mailController = new ControllerMail();
            $mailController->sendResetPasswordEmail($user->email, $resetToken->token);
           event(new Notification('success', '¡Correo electrónico enviado con éxito!'));
            return view('auth.login');
        } catch (\Exception $e) {
           event(new Notification('success', '¡Correo electrónico no encontrado!'));
            return view('auth.login');
        }
    }


    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
                'token' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user) {
               event(new Notification('success', '¡Correo electrónico no encontrado!'));
                return response()->json(['error' => 'Correo electrónico no encontrado'], 404);
            }

            $passwordResetToken = $user->passwordResetTokens()->first();

            if (!$passwordResetToken) {
               event(new Notification('success', '¡Token no encontrado!'));
                return response()->json(['error' => 'Token no encontrado'], 404);
            }

            $isValidToken = $this->validateResetToken($passwordResetToken, $request->token);

            if (!$isValidToken) {
               event(new Notification('success', '¡Token no válido!'));
                return response()->json(['error' => 'Token no válido'], 400);
            }

            $user->update([
                'password' => Hash::make($request->password),
            ]);

            // Delete the password reset token
            PasswordResetToken::where('email', $user->email)->delete();
           event(new Notification('success', '¡Contraseña restablecida exitosamente!'));
            return response()->json(['message' => 'Contraseña restablecida exitosamente'], 200);
        } catch (\Exception $e) {
           event(new Notification('success', '¡No se pudo reestablecer la contraseña!'));
            return view('auth.login');
        }
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
