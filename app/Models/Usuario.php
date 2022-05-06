<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
//use Laravel\Sanctum\HasApiTokens;



class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';

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
        'password',
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
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function novoUsuario($userData) {
        try {
            if(empty(array_filter($userData))) {
                throw new \Exception('Necessaario envio de dados!');
            }

            $userData['password'] = bcrypt($userData['password']);

            \DB::beginTransaction();

            $user = user::create($userData);

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
