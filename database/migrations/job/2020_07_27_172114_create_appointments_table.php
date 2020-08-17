<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('user_id');
            $table->tinyInteger('status')->default(0);
            $table->string('patient_name');
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('latitute');
            $table->string('longitute');
            $table->integer('visibility')->default(10);

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
        Schema::dropIfExists('appointments');
    }
}
