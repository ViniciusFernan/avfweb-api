<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cliente')) {
            Schema::create('cliente', function (Blueprint $table) {
                $table->increments('id_cliente');
                $table->bigInteger('cpf');
                $table->string('nome');
                $table->string('sobre_nome')->nullable();
                $table->string('email', '256')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->bigInteger('telefone');
                $table->bigInteger('telefone_sec')->nullable();;
                $table->integer('sexo');
                $table->date('data_nascimento');
                $table->integer('id_perfil')->unsigned();
                $table->integer('id_usuario')->unsigned();
                $table->rememberToken();
                $table->timestamps();
                $table->tinyInteger('status')->default(1);
            });

            Schema::table('cliente', function($table) {
                $table->foreign('id_perfil')->references('id_perfil')->on('perfil');
                $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
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
        Schema::dropIfExists('cliente');
    }
}
