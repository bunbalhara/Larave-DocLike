<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelowna_urgolive.appointment', function (Blueprint $table) {
            $table->integer('type');
            $table->integer('age');
            $table->string('offerBy');
            $table->string('email');
            $table->string('phone');
            $table->string('gender');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelowna_urgolive.appointment', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('age');
            $table->dropColumn('offerBy');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('gender');
        });
    }
}
