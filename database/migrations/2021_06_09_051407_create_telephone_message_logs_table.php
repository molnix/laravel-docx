<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelephoneMessageLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telephone_message_logs', function (Blueprint $table) {
            $table->bigInteger('voting_id');
            $table->bigInteger('number')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('person_transmitting')->nullable();
            $table->string('person_transmitting_status')->nullable();
            $table->string('person_adopted')->nullable();
            $table->string('person_adopted_status')->nullable();
            $table->text('content')->nullable();
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
        Schema::dropIfExists('telephone_message_logs');
    }
}
