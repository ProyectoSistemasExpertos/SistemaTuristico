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

use function PHPUnit\Framework\isEmpty;

class ControllerLogin extends Controller
{

    public function register(Request $request){

        $user = new User();

        //cosnulta para saber si el email ya existe en la BD
        $verifed_email = User::query()->where('email', '=', $request->email)->exists();

        /*if($this->userEmpty($request)){
            echo("No pueden haber datos vacios");
        }else{*/

            if(!$verifed_email){
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
    
                return redirect(route('privada'));
            }else{

                echo("Al parecer ya existe una cuenta con este correo electrónico");
           // }
        
        }

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

    //se valida que los datos del registro no vayan vacios
    private function userEmpty(Request $request){

        $user = new User();
        if($request->name == null || $request->idCard == null || $request->firstLastName == null ||
        $request->secondLastName == null || $request->phone == null || $request->Address == null ||
        $request->email == null || $request->password == null){
            return true;
        }
            return false;
    }
}
?>