<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    public function sends(Request $request){

        $receiver_phone = $request->phone;
        $sid = getenv("TWILIO_ACCOUNT_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio = new Client($sid, $token);

        $verification = $twilio->verify->v2->services("VAa66cb4b75cf215ff6b57fcb4fe873d49")
                                   ->verifications
                                   ->create($receiver_phone, "sms");

        dd("verification send successful");

    }
}
