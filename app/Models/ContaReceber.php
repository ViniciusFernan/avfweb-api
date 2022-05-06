<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
    use HasFactory;
    protected $table = 'contas_receber';

    protected $primaryKey = 'id_receber';

    public $idImovel;
    public $mesReferencia;
    public $valor;
    public $contaRecebimento;
    public $pagador;
    public $cpfPagador;
    public $categoria;
    public $status;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'mes_referencia',
        'valor',
        'conta_recebimento',
        'pagador',
        'cpf_pagador',
        'categoria',
        'status'
    ];

    public function novoContasReceber(object $contaReceber){
        try{
            if(is_null($contaReceber))
                throw new \Exception('Necessaario envio de dados!');


            $crData['id_imovel'] = $contaReceber->idImovel;
            $crData['mes_referencia'] = $contaReceber->mesReferencia;
            $crData['valor'] =  $contaReceber->valor;
            $crData['conta_recebimento'] = $contaReceber->contaRecebimento;
            $crData['pagador'] = $contaReceber->pagador;
            $crData['cpf_pagador'] = $contaReceber->cpfPagador;
            $crData['categoria'] = $contaReceber->categoria;
            $crData['descricao'] = $contaReceber->descricao;
            $crData['status'] = $contaReceber->status;

            \DB::beginTransaction();

            $contaReceber = ContaReceber::create();($crData);

            if($contaReceber instanceof \Exception)
                throw ($contaReceber);

            \DB::commit();
            return $contaReceber;
        } catch (\Exception $e) {
            \DB::rollback();
            return $e;
        }

    }


}
