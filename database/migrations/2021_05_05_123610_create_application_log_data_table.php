<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationLogDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_log_data', function (Blueprint $table) {
            $table->integer('application_log_id');
            $table->integer('number')->nullable();
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->string('participant_name')->nullable();
            $table->string('adress')->nullable();
            $table->string('person_accepted_name')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('application_log_data');
    }
}
