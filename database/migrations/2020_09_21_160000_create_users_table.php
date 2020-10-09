<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('names');
            $table->string('surnames');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('type_dni_id')->nullable();
            $table->string('dni')->unique()->nullable();
            $table->unsignedBigInteger('gender_id');
            $table->unsignedBigInteger('state_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
}
