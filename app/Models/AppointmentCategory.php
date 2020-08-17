<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentCategory extends Model
{
    protected $table = "appointment_categories";
    protected $primaryKey  = 'id';
    protected $guarded = ['id'];

    public function doctor() {
        return $this->hasMany('App\User', 'category');
    }
}
