<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request) {
        $token = $request->get('token');
        if($token){
            return view('frontend.job.create', compact('token'));
        }else{
            if(auth()->check()){
                $appointment = Appointment::where('user_id', auth()->user()->id)->first();
                if($appointment){
                    $token = $appointment->token;
                    return view('frontend.job.create', compact('token'));
                }
            }
            return view('frontend.job.create');
        }
    }
}
