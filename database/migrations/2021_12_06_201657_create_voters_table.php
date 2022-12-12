<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); 
            $table->string('user_id')->nullable();
            $table->string('email')->unique();
            $table->string('status')->nullable();
            $table->string('date')->nullable();
            $table->string('device')->nullable();
            $table->string('ip')->nullable();
            $table->string('voted_to')->nullable();
            $table->string('opening_time')->nullable();
            $table->string('voting_time')->nullable();
            $table->string('closing_time')->nullable();
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
        Schema::dropIfExists('voters');
    }
}
