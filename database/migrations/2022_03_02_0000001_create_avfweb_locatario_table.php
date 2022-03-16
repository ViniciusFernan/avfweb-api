<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvfwebLocatarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('locatario')) {
            Schema::create('locatario', function (Blueprint $table) {
                $table->increments('id_locatario');
                $table->string('nome', 50);

                $table->text('descricao');
                $table->timestamps();
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
        Schema::dropIfExists('locatario');
    }
}
