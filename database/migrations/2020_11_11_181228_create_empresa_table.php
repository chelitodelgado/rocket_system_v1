<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('empresa', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ramo');
            $table->mediumText('descripcion');
            $table->string('email');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        /* DB::table('empresa')->insert([
            [
                'nombre'      => 'Mi empresa',
                'ramo'        => 'Ventas',
                'descripcion' => 'Somos una empresa de venta de productos electronicos',
                'email'       => 'admin@gmail.com',
                'user_id'     => 1
            ],
        ]); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('empresa');
    }
}
