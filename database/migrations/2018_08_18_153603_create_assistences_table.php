<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistencesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('assistences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_ficha')->unsigned();
            $table->string('codigo', 5);
            $table->boolean('asistio');
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('id_ficha')->references('id')->on('cards')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('assistences');
    }

}
