<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSettingsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        Schema::create('user_settings', static function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('user_id');
            $table->integer('number_of_active_sessions_in_web')->default(1);
            $table->integer('number_of_active_sessions_in_mobiles')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists('user_settings');
    }
}
