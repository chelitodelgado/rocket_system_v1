<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ruc');
            $table->longText('descripcion');
            $table->integer('telefono');
            $table->string('giro');
            $table->timestamps();
        });

        DB::table('proveedor')->insert([
            [
                'nombre'      => 'Huawei',
                'ruc'         => 'BDJHSBKDAOASASDFAS',
                'descripcion' => 'Somos una empresa de venta de productos electronicos',
                'telefono'    => '111111111',
                'giro'        => 'ventas'
            ],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedor');
    }
}
