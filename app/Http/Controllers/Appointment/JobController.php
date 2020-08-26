<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentCategory;
use App\Models\AppointmentProposals;
use App\Models\AppointmentShift;
use App\Models\User;
use App\Notifications\JobExist;
use App\Notifications\JobPosted;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth:api.appointment');
        $this->middleware('cors');
    }

    public function getCategories()
    {
        $categories = AppointmentCategory::with('doctor')->get();
        return response($categories);
    }

    public function getCurrentUser(){
        $user = Auth::user();
        return response()->json($user);
    }

    public function savePost(Request $request){

        $email = $request->email;

        try{

            $appointment = Appointment::select('appointment.*','appointment_shift.*','appointment.id as id','appointment_shift.id as appointment_shift_id')
                ->join('appointment_shift','appointment.id','=','appointment_shift.appointment_id')
                ->where('email',$email)
                ->whereDate('date','>=',date('Y-m-d'))
                ->get();

            if(count($appointment) == 0){
                    $appointment = Appointment::create(array_merge($request->except(['date','start_time','end_time']),['token'=>Str::random(80)]));
                    $appointmentShift = AppointmentShift::create([
                        'date'=>$request->date,
                        'start_time'=>$request->start_time,
                        'end_time'=>$request->end_time,
                        'appointment_id'=>$appointment->id
                    ]);

                    $appointment->notify(new JobPosted());

                    return response()->json([
                        'status'=>1,
                        'appointment'=>$appointment,
                        'appointmentShift'=>$appointmentShift
                    ]);

            }else{
                $appointment = Appointment::find($appointment[0]->id);
                $appointmentShift = AppointmentShift::where('appointment_id', $appointment->id)->first();
                $appointment->notify(new JobExist());

                return response()->json([
                    'status'=>0,
                    'appointment'=>$appointment,
                    'appointmentShift'=>$appointmentShift
                ]);

            }

        }catch(\Exception $e){
            return response()->json($e);
        }
    }

    public function getAppointment(Request $request){

        $token = $request->token;
        try {
            if($token){
                $appointment = Appointment::select('appointment.*','appointment_shift.*','appointment.id as id','appointment_shift.id as appointment_shift_id')
                    ->join('appointment_shift','appointment.id','=','appointment_shift.appointment_id')
                    ->where('token',$token)
                    ->whereDate('date','>=',date('Y-m-d'))
                    ->first();
                if($appointment){
                    return response()->json([
                        'status' => 1,
                        'data'=>$appointment,
                        'message'=>'There is a appointment'
                    ]);
                }
                return response()->json([
                    'status' => 0,
                    'data'=>null,
                    'message'=>'There is no appointment'
                ]);
            }
            return response()->json([
                'status' => 0,
                'data'=>null,
                'message'=>'There is no appointment'
                ]);
        }catch (\Exception $e){
            return response([
                'status'=>0,
                'data'=>null,
                'message'=> $e->getMessage()
            ]);
        }
    }

    public function getOffers(Request $request){
        try{
            $appointmentId = $request->appointmentId;
            $proposals = AppointmentProposals::where('appointment_id', $appointmentId)->get();
            $doctors = User::whereIn('id', $proposals->pluck('doctor_id')->toArray())->get();
            return response()->json(['doctors'=>$doctors, 'proposals'=>$proposals]);
        }catch (\Exception $e){
            return response()->json(json_encode($e->getMessage()));
        }
    }

    public function getMapRoutes(Request $request){
        try {
            return response()->json($request->all());
        }catch (\Exception $e){
            return response()->json(json_encode($e->getMessage()));
        }
    }
}
