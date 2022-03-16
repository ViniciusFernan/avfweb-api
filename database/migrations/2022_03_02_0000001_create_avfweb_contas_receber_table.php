<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvfwebContasReceberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('contas_receber')) {
            Schema::create('contas_receber', function (Blueprint $table) {
                $table->increments('id_receber');
                $table->timestamps();

                $table->integer('id_imovel')->unsigned();
               //// $table->foreign('id_imovel')->references('id_imovel')->on('imovel');

                $table->string('mes_referencia', 50);
                $table->decimal('valor', 8, 2);
                $table->string('conta_recebimento', 10);
                $table->string('pagador', 250);
                $table->string('cpf_pagador', 15);
                $table->string('categoria', 50);
                $table->text('descricao');
                $table->tinyInteger('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas_receber');
    }
}
