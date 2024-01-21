<?php

namespace App\Http\Controllers;


use App\Mail\ControllerMail;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Session\Session;

class ControllerLogin extends Controller
{

    public function register(Request $request){

        $user = new User();

        $user->name = $request->name;
        $user->idCard = $request->idCard;
        $user->firstLastName = $request->firstLastName;
        $user->secondLastName = $request->secondLastName;
        $user->phone = $request->phone;
        $user->Address = $request->Address;
        $user->rol = 1;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        Auth::login($user);

        return redirect(route('privada'));

    }

    public function login(Request $request){

        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
        ];

        $remember = ($request -> has('remember') ?true : false);

        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();
            return redirect()->intended(route('privada'));
        }else{
            return redirect('login');
        }

    }

    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
?>