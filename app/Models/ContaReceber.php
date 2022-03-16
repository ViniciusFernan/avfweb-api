<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
    use HasFactory;
    protected $table = 'contas_receber';

    protected $primaryKey = 'id_receber';

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

    public function novoContasReceber(){
        try{



        } catch (\Exception $e) {
            return $e;
        }

    }


}
