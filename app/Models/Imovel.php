<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    use HasFactory;

    protected $table = 'imovel';

    protected $primaryKey = 'id_imovel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'descricao', 'valor_referencia', 'status'];


    public function getLocatarioImovel() {
        return $this->belongsToMany(Usuario::class,  'locatario_imovel', 'id_locatario', 'id_imovel');
    }
}
