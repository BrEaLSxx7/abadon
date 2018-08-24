<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('correo', 50)->unique();
            $table->string('numero_documento', 20)->unique();
            $table->integer('tipo_documento')->unsigned();
            $table->integer('genero')->unsigned();
            $table->integer('id_ficha')->unsigned()->nullable();
            $table->string('telefono', 20);

            $table->foreign('tipo_documento')->references('id')->on('document_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('genero')->references('id')->on('genders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_ficha')->references('id')->on('cards')->onDelete('cascade')->onUpdate('cascade');

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
