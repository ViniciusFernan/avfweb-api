<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('perfil')) {
            Schema::create('perfil', function (Blueprint $table) {
                    $table->increments('id_perfil');
                    $table->string('nome', 300);
                    $table->tinyInteger('super_admin')->default('0');
                    $table->timestamps();
                    $table->tinyInteger('status');
                }
            );

            \DB::table("perfil")->insert(
                [
                    ['id_perfil' => '1', 'nome' => 'SuperAdmin', 'super_admin' => 1,'status' => '1'],
                    ['id_perfil' => '3', 'nome' => 'Admin', 'super_admin' => 0, 'status' => '1'],
                    ['id_perfil' => '5', 'nome' => 'Usuario', 'super_admin' => 0, 'status' => '1']
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil');
    }
}
