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
use Illuminate\Support\Facades\Session;

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
           Session::flash('success',['message' =>  '¡Registro exitoso! Bienvenido a nuestro sitio!', 'duration' => 2000]);
            return redirect()->route('home')->with('success', '¡Registro exitoso! Bienvenido a nuestro sitio.');
        } catch (\Exception $e) {
           Session::flash('success',['message' =>  '¡Registro fallido! El correo electrónico ya está registrado.', 'duration' => 2000]);
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
           Session::flash('success',['message' =>  '¡Inicio de sesión exitoso!', 'duration' => 2000]);
            //return response()->json(['message' => 'Inicio de sesión exitoso', 'user' => $user, 'access_token' => $token], 200);
            return redirect()->route('booking.index')->with(201);
        } else {
           Session::flash('success',['message' =>  'Credenciales inválidas!', 'duration' => 2000]);
            return redirect()->route('login')->with('success', 'Credenciales inválidas!');
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
           Session::flash('success',['message' =>  '¡Cierre de Sesión Exitoso!', 'duration' => 2000]);
            return redirect()->route('login')->with('success', 'Bienvenido de nuevo.');
        } catch (\Exception $e) {
           Session::flash('success',['message' =>  '¡Cierre de Sesión Fallido!', 'duration' => 2000]);
            return redirect()->route('login')->with('success', 'Bienvenido de nuevo.');
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
               Session::flash('success',['message' =>  '¡Correo electrósdnico no encontrado!', 'duration' => 2000]);
                return view('home');
            }
            PasswordResetToken::where('email', $user->email)->delete();
            $resetToken = PasswordResetToken::create([
                'email' => $user->email,
                'token' => bin2hex(random_bytes(32)),
            ]);
            $mailController = new ControllerMail();
            $mailController->sendResetPasswordEmail($user->email, $resetToken->token);
           Session::flash('success',['message' =>  '¡Correo electrónico enviado con éxito!', 'duration' => 2000]);
            return view('login');
        } catch (\Exception $e) {
           Session::flash('success',['message' =>  '¡Correo electrónico no encontrado!', 'duration' => 2000]);
            return view('login');
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
               Session::flash('success',['message' =>  '¡Correo electrónico no encontrado!', 'duration' => 2000]);
                return response()->json(['error' => 'Correo electrónico no encontrado'], 404);
            }

            $passwordResetToken = $user->passwordResetTokens()->first();

            if (!$passwordResetToken) {
               Session::flash('success',['message' =>  '¡Token no encontrado!', 'duration' => 2000]);
                return response()->json(['error' => 'Token no encontrado'], 404);
            }

            $isValidToken = $this->validateResetToken($passwordResetToken, $request->token);

            if (!$isValidToken) {
               Session::flash('success',['message' =>  '¡Token no válido!', 'duration' => 2000]);
                return response()->json(['error' => 'Token no válido'], 400);
            }

            $user->update([
                'password' => Hash::make($request->password),
            ]);

            // Delete the password reset token
            PasswordResetToken::where('email', $user->email)->delete();
           Session::flash('success',['message' =>  '¡Contraseña restablecida exitosamente!', 'duration' => 2000]);
            return response()->json(['message' => 'Contraseña restablecida exitosamente'], 200);
        } catch (\Exception $e) {
           Session::flash('success',['message' =>  '¡No se pudo reestablecer la contraseña!', 'duration' => 2000]);
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
