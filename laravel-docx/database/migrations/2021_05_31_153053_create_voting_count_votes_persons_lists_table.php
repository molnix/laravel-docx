<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotingCountVotesPersonsListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voting_count_votes_persons_lists', function (Blueprint $table) {
            $table->bigInteger('voting_id');
            $table->integer('number')->nullable();
            $table->string('name')->nullable();
            $table->string('status')->nullable();
            $table->string('represent')->nullable();
            $table->string('contact')->nullable();
            $table->string('hours_start')->nullable();
            $table->string('minuts_start')->nullable();
            $table->string('hours_end')->nullable();
            $table->string('minuts_end')->nullable();
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
        Schema::dropIfExists('voting_count_votes_persons_lists');
    }
}
