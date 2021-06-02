<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFireSafetyInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fire_safety_instructions', function (Blueprint $table) {
            $table->integer('voting_id');
            $table->string('man_fire_safety')->nullable();
            $table->string('allowed_number')->nullable();
            $table->string('man_fire_safety2')->nullable();
            $table->string('man_message_fire')->nullable();
            $table->string('address_object')->nullable();
            $table->string('man_evacuation')->nullable();
            $table->string('man_fire_protection_check')->nullable();
            $table->string('man_power_outage')->nullable();
            $table->string('place_power_outage')->nullable();
            $table->string('man_work_stoppage')->nullable();
            $table->string('man_guide')->nullable();
            $table->string('man_evacuation2')->nullable();
            $table->string('man_meeting')->nullable();
            $table->string('man_guide2')->nullable();
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
        Schema::dropIfExists('fire_safety_instructions');
    }
}
