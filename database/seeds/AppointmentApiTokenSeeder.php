<?php

use Illuminate\Database\Seeder;

class AppointmentApiTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appointments = \App\Models\Appointment::all();
        foreach ($appointments as $appointment){
            $appointment->token = \Illuminate\Support\Str::random(80);
            $appointment->save();
        }
    }
}
