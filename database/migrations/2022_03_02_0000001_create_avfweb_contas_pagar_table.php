<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvfwebContasPagarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('contas_pagar')) {
            Schema::create('contas_pagar', function (Blueprint $table) {
                $table->increments('id_pagar');
                $table->timestamps();
                $table->string('mes_referencia', 50);
                $table->decimal('valor', 8, 2);
                $table->string('conta_pagamento', 10);
                $table->string('favorecido', 250);
                $table->string('cpf_favorecido', 15);
                $table->string('categoria', 50);
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
        Schema::dropIfExists('contas_pagar');
    }
}
