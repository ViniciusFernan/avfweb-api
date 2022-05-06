<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Models\Perfil;

class Helper
{

    /**
     * Remove acentuacao da string
     * @param String $str
     * @return String
     */
    public static function removeAcentos(string $str) {
        // assume $str esteja em UTF-8
        $from = "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ";
        $to = "aaaaeeiooouucAAAAEEIOOOUUC";
        $keys = array();
        $values = array();
        preg_match_all('/./u', $from, $keys);
        preg_match_all('/./u', $to, $values);
        $mapping = array_combine($keys[0], $values[0]);
        return strtr($str, $mapping);
    }

    public static function ternary(string $key, object $object = null) {
        $resp = '';
        if(is_object($object) && !empty($object)) {
             if(isset($object->$key) && !empty($object->$key)){
                 $resp = $object->$key;
             }
        } else if (is_array($object) && isset($object[$key]) && !empty($object[$key])) {
            $resp = $object[$key];
        }
        return $resp;
    }

    /**
     * @param $mensagem
     * @param  int  $status | 1 = "success" : 3 = "question" : * = "error"
     * @return array[]
     */
    public static function alertView(string $mensagem, int $status = 1) {
        return ['status' => $status, 'msg' => $mensagem ];
    }

    public static function hasPermission(string $recurso) {
        $rules = Auth::user()->getUserRules()->get();
        $resp = false;
        foreach ($rules as $rule) :
            if(strtolower($rule->recurso) == strtolower($recurso)) :
                $resp = true;
            endif;
        endforeach;

        return $resp;
    }

    public static function hasPermissionsGrup(array $recursos, int $all = 1) {
        $rules = Auth::user()->getUserRules()->get();
        $resp = false;
        $recursoDisponivel =[];
        if(is_array($recursos)) :
            foreach ($recursos as $key => $recurso) :
                foreach ($rules as $rule) :
                    if(strtolower($rule->recurso) == strtolower($recurso)) $recursoDisponivel[$key] = $recurso;
                 endforeach;
            endforeach;
        endif;

        $dif = array_diff($recursos, $recursoDisponivel);
        if($all == 1 && count($dif)==0 ) :
            $resp = true;
        elseif ($all == 0 && count($recursoDisponivel)>0) :
            $resp = true;
        endif;


        return $resp;
    }

    public static function hasSuperAdmin() {
        $superAdmin = false;

        $perfilUsuario = Perfil::where([['id_perfil', '=', Auth::user()->id_perfil], ['status', '=', '1']] )->first();
        if($perfilUsuario && $perfilUsuario->super_admin == 1)  $superAdmin =  true;

        return $superAdmin;
    }

    public static function validarCpf(string $string){
        $clearCpf = preg_replace('/[^0-9]/', '', $string);
        if(is_numeric($clearCpf)){
            $clearCpf = substr(str_repeat("0",11).$clearCpf, -11);
            return $clearCpf;
        }
        return null;
    }
    public static function separarDddTelefone(string $str) {
        return [
            'ddd' => trim(substr(trim($str), 0, 2)),
            'telefone' => trim(substr(trim($str), -9)),
        ];

    }


}
