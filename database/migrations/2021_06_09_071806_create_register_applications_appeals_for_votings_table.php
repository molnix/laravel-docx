<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterApplicationsAppealsForVotingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_applications_appeals_for_votings', function (Blueprint $table) {
            $table->bigInteger('voting_id');
            $table->string('voter_name')->nullable();
            $table->string('voter_address')->nullable();
            $table->text('reason_calling_commission')->nullable();
            $table->dateTime('datetime_oral_appeal')->nullable();
            $table->dateTime('datetime_written_appeal')->nullable();
            $table->string('name_transmitting_appeal')->nullable();
            $table->string('address_transmitting_appeal')->nullable();
            $table->string('name_accepted_appeal')->nullable();
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
        Schema::dropIfExists('register_applications_appeals_for_votings');
    }
}
