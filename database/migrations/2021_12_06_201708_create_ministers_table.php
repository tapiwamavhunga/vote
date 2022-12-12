<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); 
            $table->string('user_id')->nullable();
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->string('counter')->nullable();
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
        Schema::dropIfExists('ministers');
    }
}
