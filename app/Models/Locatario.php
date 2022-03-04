<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locatario extends Model
{
    use HasFactory;

    protected $table = 'locatario';

    protected $primaryKey = 'id_locatario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'descricao', 'status'];


    public function getLocatarioImovel() {
        return $this->belongsToMany(Rule::class,  'locatario_imovel', 'id_locatario', 'id_imovel');
    }
}
