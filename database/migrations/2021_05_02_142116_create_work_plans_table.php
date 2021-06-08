<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_plans', function (Blueprint $table) {
            $table->integer('voting_id');
            $table->string('conduct_meeting_date')->nullable();
            $table->string('reception_and_registration_start_date')->nullable();
            $table->string('reception_and_registration_end_time')->nullable();
            $table->string('active_suffrage_start_date')->nullable();
            $table->string('active_suffrage_end_date')->nullable();
            $table->string('active_suffrage_start_time')->nullable();
            $table->string('active_suffrage_end_time')->nullable();
            $table->string('active_suffrage_open_voting_room_time')->nullable();
            $table->string('active_suffrage_in_opening_voting_room_start_time')->nullable();
            $table->string('active_suffrage_in_opening_voting_room_end_time')->nullable();
            $table->string('active_suffrage_out_opening_voting_room_start_time')->nullable();
            $table->string('active_suffrage_out_opening_voting_room_end_time')->nullable();
            $table->string('submission_documents_date')->nullable();
            $table->string('preparation_submission_reports_date')->nullable();
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
        Schema::dropIfExists('work_plans');
    }
}
