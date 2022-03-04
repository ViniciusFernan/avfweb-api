<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocatarioImovel extends Model
{
    use HasFactory;

    protected $table = 'locatario_imovel';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['id_locatario', 'id_imovel'];
}

