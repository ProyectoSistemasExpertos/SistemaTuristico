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
use App\Models\Recommendations;
use Illuminate\Support\Facades\Session;

class ControllerAuth extends Controller
{
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
           Session::flash('success',['message' =>  '¡Registro exitoso! Ya puedes iniciar sesión!', 'duration' => 2500]);
            return view('auth.login');
        } catch (\Exception $e) {
           Session::flash('error',['message' =>  '¡Registro fallido! El correo electrónico ya está registrado.', 'duration' => 2500]);
            return view('auth.register');
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
           Session::flash('success',['message' =>  '¡Inicio de sesión exitoso!', 'duration' => 2500]);
            $idPerson = $user->id;
            $isRecommendationExists = Recommendations::where('idPerson',$idPerson)->get();
            if($isRecommendationExists->isEmpty()){
                return redirect()->route('booking.index')->with(201);
            }
            return redirect()->route('recommendation.showRecommendation',$user->id);
        } else {
           Session::flash('error',['message' =>  '¡Credenciales inválidas!', 'duration' => 2500]);
            return view('auth.login');
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
           Session::flash('error',['message' =>  '¡Cierre de Sesión Exitoso!', 'duration' => 2500]);
            return view('auth.login');
        } catch (\Exception $e) {
           Session::flash('error',['message' =>  '¡Cierre de Sesión Fallido!', 'duration' => 2500]);
            return view('auth.login');
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);
            $user = User::where('email', $request->email)->first();
            PasswordResetToken::where('email', $user->email)->delete();
            $resetToken = PasswordResetToken::create([
                'email' => $user->email,
                'token' => bin2hex(random_bytes(32)),
            ]);
            $mailController = new ControllerMail();
            $mailController->sendResetPasswordEmail($user->email, $resetToken->token);
           Session::flash('success',['message' =>  '¡Correo electrónico enviado con éxito!', 'duration' => 2500]);
            return view('auth.login');
        } catch (\Exception $e) {
           Session::flash('error',['message' =>  '¡Correo electrónico no encontrado!', 'duration' => 2500]);
           return view('auth.forgot-password');
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
               Session::flash('error',['message' =>  '¡Correo electrónico no encontrado!', 'duration' => 2500]);
               return view('auth.login');
            }

            $passwordResetToken = $user->passwordResetTokens()->first();

            if (!$passwordResetToken) {
               Session::flash('error',['message' =>  '¡Token no encontrado!', 'duration' => 2500]);
               return view('auth.login');
            }

            $isValidToken = $this->validateResetToken($passwordResetToken, $request->token);

            if (!$isValidToken) {
               Session::flash('error',['message' =>  '¡Token no válido!', 'duration' => 2500]);
               return view('auth.login');
            }

            $user->update([
                'password' => Hash::make($request->password),
            ]);

            // Delete the password reset token
            PasswordResetToken::where('email', $user->email)->delete();
           Session::flash('success',['message' =>  '¡Contraseña restablecida exitosamente!', 'duration' => 2500]);
           return view('auth.login');
        } catch (\Exception $e) {
           Session::flash('error',['message' =>  '¡No se pudo restablecer la contraseña!', 'duration' => 2500]);
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

}
