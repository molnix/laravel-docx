<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogOutgoingPECDocumentsRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_outgoing_p_e_c_documents_registrations', function (Blueprint $table) {
            $table->bigInteger('voting_id');
            $table->date('date')->nullable();
            $table->string('number')->nullable();
            $table->string('recipient')->nullable();
            $table->text('summary_document')->nullable();
            $table->string('person_signed_doc')->nullable();
            $table->string('executor')->nullable();
            $table->string('case')->nullable();
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
        Schema::dropIfExists('log_outgoing_p_e_c_documents_registrations');
    }
}
