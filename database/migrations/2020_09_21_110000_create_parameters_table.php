<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParametersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('parameters', static function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('value_id');
            $table->string('name', 100);
            $table->char('state');
            $table->string('description')->default('Sin def.');
            $table->timestamps();

            $table->foreign('value_id')->references('id')->on('values');
            $table->unique(['value_id', 'name']);

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('parameters');
    }
}
