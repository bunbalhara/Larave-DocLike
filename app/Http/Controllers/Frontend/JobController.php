<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request) {
        return view('frontend.job.create');
    }
}
