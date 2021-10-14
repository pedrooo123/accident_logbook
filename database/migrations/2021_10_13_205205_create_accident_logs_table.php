<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccidentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accident_logs', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // road accident, air crash, train crash
            $table->string('location')->nullable();
            $table->string('licence_plate')->nullable();
            $table->string('flight_number')->nullable();
            $table->string('injured_people')->nullable();
            $table->string('description')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('accident_logs');
    }
}
