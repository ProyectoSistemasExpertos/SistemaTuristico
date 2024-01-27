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
        $user = new User();

        // Consulta para saber si el email ya existe en la BD
        $verifiedEmail = User::query()->where('email', '=', $request->email)->exists();

        if (!$this->userEmpty($request)) {
            if (!$verifiedEmail) {
                $user->name = $request->name;
                $user->idCard = $request->idCard;
                $user->firstLastName = $request->firstLastName;
                $user->secondLastName = $request->secondLastName;
                $user->phone = $request->phone;
                $user->address = $request->address;
                $user->rol = 1;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);

                $user->save();

                Auth::login($user);

                return response()->json(['message' => 'Registro exitoso', 'user' => $user], 200);
            } else {
                return response()->json(['error' => 'El correo electrónico ya está registrado'], 400);
            }
        } else {
            return response()->json(['error' => 'Todos los campos son obligatorios'], 400);
        }
    }

    public function login(Request $request)
    {
        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
        ];

        $remember = ($request->has('remember') ? true : false);

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

    // Se valida que los datos del registro no vayan vacíos
    private function userEmpty(Request $request)
    {
        if (
            $request->name == null || $request->idCard == null || $request->firstLastName == null ||
            $request->secondLastName == null || $request->phone == null || $request->address == null ||
            $request->email == null || $request->password == null
        ) {
            return true;
        }

        return false;
    }
}

?>
