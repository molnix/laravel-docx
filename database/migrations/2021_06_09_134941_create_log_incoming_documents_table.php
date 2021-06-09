<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogIncomingDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_incoming_documents', function (Blueprint $table) {
            $table->bigInteger('voting_id');
            $table->date('date_receipt')->nullable();
            $table->string('number')->nullable();
            $table->string('correspondent')->nullable();
            $table->string('number_doc')->nullable();
            $table->date('date_doc')->nullable();
            $table->text('content')->nullable();
            $table->text('resolution')->nullable();
            $table->string('executer')->nullable();
            $table->string('term_start')->nullable();
            $table->string('term_end')->nullable();
            $table->string('mark')->nullable();
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
        Schema::dropIfExists('log_incoming_documents');
    }
}
