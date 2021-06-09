<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogRegistrationDecisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_registration_decisions', function (Blueprint $table) {
            $table->bigInteger('voting_id');
            $table->date('date')->nullable();
            $table->string('number')->nullable();
            $table->string('name')->nullable();
            $table->string('number_sheets_decisions')->nullable();
            $table->string('number_sheets_applications')->nullable();
            $table->string('executor')->nullable();
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
        Schema::dropIfExists('log_registration_decisions');
    }
}
