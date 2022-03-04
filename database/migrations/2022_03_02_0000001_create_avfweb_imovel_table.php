<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvfwebImovelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('imovel')) {
            Schema::create('imovel', function (Blueprint $table) {
                $table->increments('id_imovel');
                $table->string('nome', 50);
                $table->text('descricao');
                $table->decimal('valor_referencia', 8, 2);
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
        Schema::dropIfExists('imovel');
    }
}
