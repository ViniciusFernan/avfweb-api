<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvfwebLocatarioImovelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('locatario_imovel')) {
            Schema::create('locatario_imovel', function (Blueprint $table) {
                $table->integer('id_locatario')->unsigned();
                $table->integer('id_imovel')->unsigned();
                $table->timestamps();
            });

            Schema::table('locatario_imovel', function ($table) {
                $table->foreign('id_locatario')->references('id_locatario')->on('locatario');
                $table->foreign('id_imovel')->references('id_imovel')->on('imovel');
            });
        }
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('locatario_imovel');
    }
}
