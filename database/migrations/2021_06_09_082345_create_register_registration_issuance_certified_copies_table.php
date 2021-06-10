<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterRegistrationIssuanceCertifiedCopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_registration_issuance_certified_copies', function (Blueprint $table) {
            $table->bigInteger('voting_id');
            $table->string('number')->nullable();
            $table->string('person_accepted_protocol')->nullable();
            $table->string('person_accepted_protocol_status')->nullable();
            $table->string('personal_assured_name')->nullable();
            $table->dateTime('datetime_issuing')->nullable();
            $table->string('telephone')->nullable();
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
        Schema::dropIfExists('register_registration_issuance_certified_copies');
    }
}
