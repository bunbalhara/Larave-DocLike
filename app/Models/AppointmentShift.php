<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentShift extends Model
{
    protected $connection='mysql2';
    protected $table = "appointment_shift";
    protected $primaryKey  = 'id';
    protected $guarded = ['id'];

    public function appointment()
    {
        return $this->hasOne('App\Models\Appointment', 'id', 'appointment_id');
    }
}
