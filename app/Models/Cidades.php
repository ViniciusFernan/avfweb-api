<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Cidades
{
    use HasFactory, Notifiable;

    public $codigo;
    public $nome;
    public $uf;

    protected $fillable = [
        'codigo',
        'nome',
        'uf',
    ];
}
