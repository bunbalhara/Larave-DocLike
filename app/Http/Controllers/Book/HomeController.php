<?php

namespace App\Http\Controllers\Book;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\SyncGrant;

class HomeController extends Controller
{

    public function index(Request $request){
        $token = $request->get('token');
        $twilioToken = $this->getToken();
        if($token){
            return view('frontend.job.create', compact('token','twilioToken'));
        }else{
            if(auth()->check()){
                $appointment = Appointment::where('user_id', auth()->user()->id)->first();
                if($appointment){
                    $token = $appointment->token;
                    return view('frontend.job.create', compact('token','twilioToken'));
                }
            }
            return redirect()->route('home');
        }
    }

    // This function should be held in a more secure class in your code
    protected function getToken() {
        // Create yourself an identity for your token
        $identity = "86425";

        // Creates an access token, which we will then serialize and send to the client
        $token = new AccessToken(
            env('TWILIO_ACCOUNT_SID'),
            env('TWILIO_SYNC_API_KEY'),
            env('TWILIO_SYNC_API_SECRET'),
            3600,
            $identity
        );

        // Grant access to Sync
        $syncGrant = new SyncGrant();
        $syncGrant->setServiceSid(env('TWILIO_SYNC_SERVICE_SID'));
        $token->addGrant($syncGrant);

        return $token->toJWT();
    }
}
