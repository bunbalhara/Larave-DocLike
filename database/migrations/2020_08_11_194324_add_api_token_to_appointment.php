<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Str;

class AddApiTokenToAppointment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->table('appointment', function (Blueprint $table) {
            $table->string('token', 80)
                ->unique()
                ->nullable()
                ->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->table('appointment', function (Blueprint $table) {
            $table->dropColumn('api_token');
        });
    }
}
