<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class VerificationController extends Controller
{
    public function showVerificationForm()
    {
        return view('verification');
    }

    public function sendVerificationCode(Request $request)
    {
        $phoneNumber = $request->input('phone');

        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilio = new Client($sid, $token);

        try {
            $verification = $twilio->verify->v2->services(env('TWILIO_VERIFICATION_SID'))
                ->verifications
                ->create($phoneNumber, 'sms');

            return redirect()->back()->with('success', 'Código de verificación enviado al número: ' . $phoneNumber);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al enviar el código de verificación: ' . $e->getMessage());
        }
    }

    public function verifyCode(Request $request)
    {
        $phoneNumber = $request->input('phone');
        $code = $request->input('code');

        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilio = new Client($sid, $token);

        try {
            $verification = $twilio->verify->v2->services(env('TWILIO_VERIFICATION_SID'))
                ->verificationChecks
                ->create(['code' => $code, 'to' => $phoneNumber]);

            if ($verification->status == 'approved') {
                $user = Post::where('phone', $phoneNumber)->first();
                if ($user) {
                    $user->verified = true;
                    $user->save();
                } else {
                    $user = Post::create([
                        'name' => 'Usuario',
                        'phone' => $phoneNumber,
                        'verified' => true,
                    ]);
                }

                return redirect()->back()->with('success', 'Número de teléfono verificado correctamente');
            } else {
                return redirect()->back()->with('error', 'Código de verificación inválido');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al verificar el código: ' . $e->getMessage());
        }
    }
}
