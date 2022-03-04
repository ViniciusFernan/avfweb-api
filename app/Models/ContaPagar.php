<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaPagar extends Model
{
    use HasFactory;
    protected $table = 'contas_pagar';

    protected $primaryKey = 'id_pagar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mes_referencia',
        'valor',
        'conta_pagamento',
        'favorecido',
        'cpf_favorecido',
        'categoria',
        'status'
    ];

}
