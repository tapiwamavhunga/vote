<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); 
            $table->string('user_id')->nullable();
            $table->string('email')->unique();
            $table->string('candidate_email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('type')->default('User');
            $table->string('status')->default('Active'); 
            $table->string('reason')->nullable(); 
            $table->string('phone')->nullable();
            $table->string('voted_to')->nullable();
            $table->string('voted_time')->nullable();
            $table->string('image')->nullable();
            $table->string('device')->nullable();
            $table->string('availability')->default('Offline');
            $table->datetime('login_at')->nullable();
            $table->datetime('logout_at')->nullable();
            $table->string('login_ip')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
