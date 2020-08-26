<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\SyncGrant;

class JobController extends Controller
{
    public function index(Request $request) {
        $twilioToken = $this->getToken();
        return view('frontend.job.create', compact('twilioToken'));
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
