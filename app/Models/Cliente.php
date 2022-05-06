<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;




class Cliente extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cpf',
        'nome',
        'sobre_nome',
        'email',
        'telefone',
        'sexo',
        'data_nascimento',
        'id_perfil'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function novoCliente($userData) {
        try {
            if(empty(array_filter($userData))) {
                throw new \Exception('Necessaario envio de dados!');
            }

            $userData['data_nascimento'] = date('Y-m-d',strtotime($userData['data_nascimento']));
            $userData['telefone'] = str_replace([' ', "\t", "\n", '(', ')'], '', $userData['telefone']);
            $userData['cpf'] = str_replace(['-', '.', '_','/'], '', $userData['cpf']);
            $userData['id_perfil'] = 5;

            \DB::beginTransaction();

            $user = cliente::create($userData);

            if($user instanceof \Exception)
                throw ($user);

            \DB::commit();

            return $user;
        } catch (\Exception $e) {
            \DB::rollback();
            return $e;
        }
    }


}
