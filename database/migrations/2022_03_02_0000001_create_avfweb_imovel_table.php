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

            \DB::table("imovel")->insert(
                [
                    [ 'id_imovel' => 1, 'nome' => 'Comodo 1', 'descricao' => '' , 'valor_referencia' => '850.00', 'created_at' => NOW(), 'status' => '1' ],
                    [ 'id_imovel' => 2, 'nome' => 'Comodo 2', 'descricao' => '' , 'valor_referencia' => '850.00', 'created_at' => NOW(), 'status' => '1' ],
                    [ 'id_imovel' => 3, 'nome' => 'Comodo 3', 'descricao' => '' , 'valor_referencia' => '850.00', 'created_at' => NOW(), 'status' => '1' ],
                    [ 'id_imovel' => 4, 'nome' => 'Comodo 4', 'descricao' => '' , 'valor_referencia' => '500.00', 'created_at' => NOW(), 'status' => '1' ],
                    [ 'id_imovel' => 5, 'nome' => 'Comodo 5', 'descricao' => '' , 'valor_referencia' => '500.00', 'created_at' => NOW(), 'status' => '1' ],
                    [ 'id_imovel' => 6, 'nome' => 'Casa 1', 'descricao' => '' , 'valor_referencia' => '950.00', 'created_at' => NOW(), 'status' => '1' ],
                    [ 'id_imovel' => 7, 'nome' => 'Casa 2', 'descricao' => '' , 'valor_referencia' => '800.00', 'created_at' => NOW(), 'status' => '1' ]
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
        Schema::dropIfExists('imovel');
    }
}
