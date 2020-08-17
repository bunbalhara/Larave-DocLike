<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_proposals', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('appointment_id');
            $table->integer('appointment_shift_id');
            $table->integer('appointment_doctor_id');
            $table->date('applied_date');
            $table->time('applied_time');
            $table->tinyInteger('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_proposals');
    }
}
