<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginHistoriesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        Schema::create('login_histories', static function (Blueprint $table) {

            $table->id('id');
            $table->unsignedBigInteger('user_id');
            $table->string('ip_address')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('browser')->nullable();
            $table->string('browser_version')->nullable();
            $table->unsignedBigInteger('medium_id');
            $table->unsignedBigInteger('state_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('medium_id')->references('id')->on('parameters');
            $table->foreign('state_id')->references('id')->on('parameters');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists('login_histories');
    }
}
