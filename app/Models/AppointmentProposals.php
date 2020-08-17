<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentProposals extends Model
{
    protected $connection='mysql2';
    protected $table = "appointment_proposals";
    protected $primaryKey  = 'id';
    protected $guarded = ['id'];

    public function doctor()
    {
        return $this->hasOne('App\User', 'id', 'doctor_id');
    }

    public function appointment()
    {
        return $this->hasOne('App\Models\Appointment', 'id', 'appointment_id');
    }
}
