<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;


class ControllerMail extends Controller
{
    public function sendResetPasswordEmail($email, $token)
    {
        try {
            $resetLink = 'http://patricklisby.com/reset-password/' . $token;

            Mail::to($email)->send(new ResetPasswordMail($resetLink));

            return response()->json(['message' => 'Correo de recuperación enviado exitosamente'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['error' => 'Error al enviar el correo de recuperación',$e], 500);
        }
    }
}
