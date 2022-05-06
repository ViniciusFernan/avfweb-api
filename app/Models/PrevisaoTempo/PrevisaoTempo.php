<?php

namespace App\Models\PrevisaoTempo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cidades as Cidades;


class PrevisaoTempo extends Model
{
    use HasFactory;

    public function getPrevisaoTempoCapitais() {
        try{

            $urlSoap = env('CPTEC_BASE').'/capitais/condicoesAtuais.xml';
            $pevisaoTempo = json_decode(json_encode(simplexml_load_file($urlSoap)), true);

            if(empty($pevisaoTempo)) throw new \Exception('Não há previsão atualizada das capitais');

            return $pevisaoTempo;
        } catch (\Exception $e) {
            return $e;
        }

    }

    public function getPrevisaoTempoPorCidade($cidade, $qtdDias = 7) {
        try{
            $urlSoap = config('app.cptec_url').'/cidade/'.$qtdDias.'dias/'.$cidade.'/previsao.xml';
            $pevisaoTempo = json_decode(json_encode(simplexml_load_file($urlSoap)), true);

            if(empty($pevisaoTempo)) throw new \Exception('Não foi possivel acessar a base da dados[CPTEC]');
            if(!isset($pevisaoTempo['nome']) || $pevisaoTempo['nome'] == 'null') throw new \Exception('Base da dados[CPTEC] sem resultados!');


            if(isset($pevisaoTempo['previsao']) && !empty($pevisaoTempo['previsao'])) {
                foreach ($pevisaoTempo['previsao'] as $key => $value) {
                    if(isset($value['tempo']) && !empty($value['tempo'])) {
                        $pevisaoTempo['previsao'][$key]['dia'] = $this->getDiaDaSemana($value['dia']);
                        $pevisaoTempo['previsao'][$key]['data'] = date('d/m/Y', strtotime($value['dia']));
                        $pevisaoTempo['previsao'][$key]['tempo'] = $this->getCondicoesDoTempo($value['tempo']);
                    }
                }
            }


            return $pevisaoTempo;

        } catch (\Exception $e) {
            return $e;
        }
    }

    private function getCondicoesDoTempo($tempoC) {

        $tempoDic = [
            'ec' => ['desc' => 'Encoberto com Chuvas Isoladas',         'icon' => "fas fa-cloud-sun-rain"],
            'ci' => ['desc' => 'Chuvas Isoladas',                       'icon' => "fas fa-cloud-showers-heavy"],
            'c'  => ['desc' => 'Chuva',                                 'icon' => "fas fa-cloud-rain"],
            'in' => ['desc' => 'Instável',                              'icon' => "fas fa-cloud-sun-rain"],
            'pp' => ['desc' => 'Possibilidade de Pancadas de Chuva',    'icon' => "fas fa-cloud-sun-rain" ],
            'cm' => ['desc' => 'Chuva pela Manhã',                      'icon' => "fas fa-cloud-sun-rain"],
            'cn' => ['desc' => 'Chuva a Noite',                         'icon' => "fas fa-cloud-moon-rain"],
            'pt' => ['desc' => 'Pancadas de Chuva a Tarde',             'icon' => "fas fa-cloud-sun-rain"],
            'pm' => ['desc' => 'Pancadas de Chuva pela Manhã',          'icon' => "fas fa-cloud-sun-rain"],
            'np' => ['desc' => 'Nublado e Pancadas de Chuva',           'icon' => "fas fa-cloud-rain"],
            'pc' => ['desc' => 'Pancadas de Chuva',                     'icon' => "fas fa-cloud-rain"],
            'pn' => ['desc' => 'Parcialmente Nublado',                  'icon' => "fad fa-sun-cloud"],
            'cv' => ['desc' => 'Chuvisco',                              'icon' => "fas fa-cloud-drizzle"],
            'ch' => ['desc' => 'Chuvoso',                               'icon' => "fas fa-cloud-rain"],
            't'  => ['desc' => 'Tempestade',                            'icon' => "fas fa-thunderstorm"],
            'ps' => ['desc' => 'Predomínio de Sol',                     'icon' => "fas fa-sun-cloud"],
            'e'  => ['desc' => 'Encoberto',                             'icon' => "fas fa-smoke"],
            'n'  => ['desc' => 'Nublado',                               'icon' => "fas fa-smoke"],
            'cl' => ['desc' => 'Céu Claro',                             'icon' => "fas fa-sun"],
            'nv' => ['desc' => 'Nevoeiro',                              'icon' => "fas fa-snow-blowing"],
            'g'  => ['desc' => 'Geada',                                 'icon' => "fas fa-cloud-snow"],
            'ne' => ['desc' => 'Neve',                                  'icon' => "fal fa-snowflakes"],
            'nd' => ['desc' => 'Não Definido',                          'icon' => "fas fa-umbrella"],
            'pnt'=> ['desc' => 'Pancadas de Chuva a Noite',             'icon' => "fas fa-cloud-moon-rain"],
            'psc'=> ['desc' => 'Possibilidade de Chuva',                'icon' => "fas fa-raindrops"],
            'pcm'=> ['desc' => 'Possibilidade de Chuva pela Manhã',     'icon' => "fas fa-cloud-sun-rain"],
            'pct'=> ['desc' => 'Possibilidade de Chuva a Tarde',        'icon' => "fas fa-cloud-sun-rain"],
            'pcn'=> ['desc' => 'Possibilidade de Chuva a Noite',        'icon' => "fas fa-cloud-moon-rain"],
            'npt'=> ['desc' => 'Nublado com Pancadas a Tarde',          'icon' => "fas fa-cloud-sun-rain"],
            'npn'=> ['desc' => 'Nublado com Pancadas a Noite',          'icon' => "fas fa-cloud-moon-rain"],
            'ncn'=> ['desc' => 'Nublado com Poss. de Chuva a Noite',    'icon' => "fas fa-cloud-moon-rain"],
            'nct'=> ['desc' => 'Nublado com Poss. de Chuva a Tarde',    'icon' => "fas fa-cloud-sun-rain"],
            'ncm'=> ['desc' => 'Nubl. c/ Poss. de Chuva pela Manhã',    'icon' => "fas fa-cloud-sun-rain"],
            'npm'=> ['desc' => 'Nublado com Pancadas pela Manhã',       'icon' => "fas fa-cloud-sun-rain"],
            'npp'=> ['desc' => 'Nublado com Possibilidade de Chuva',    'icon' => "fas fa-cloud-sun-rain"],
            'vn' => ['desc' => 'Variação de Nebulosidade',              'icon' => "fas fa-clouds-sun"],
            'ct' => ['desc' => 'Chuva a Tarde',                         'icon' => "fas fa-cloud-showers-heavy"],
            'ppn'=> ['desc' => 'Poss. de Panc. de Chuva a Noite',       'icon' => "fas fa-cloud-moon-rain"],
            'ppt'=> ['desc' => 'Poss. de Panc. de Chuva a Tarde',       'icon' => "fas fa-cloud-sun-rain"],
            'ppm'=> ['desc' => 'Poss. de Panc. de Chuva pela Manhã',    'icon' => "fas fa-cloud-sun-rain"],
        ];

        $retorno = $tempoDic['nd'];
        if(array_key_exists($tempoC, $tempoDic)){
            $retorno = $tempoDic[$tempoC];
        }
        return $retorno;
    }

    private function getDiaDaSemana($data){
        $day = $data;
        $day = date("l", strtotime($day));
        $diaDaSemana = [
            "Monday"    => "Segunda-feira",
            "Tuesday"   => "Terça-feira",
            "Wednesday" => "Quarta-feira",
            "Thursday"  => "Quinta-feira",
            "Friday"    => "Sexta-feira",
            "Saturday"  => "Sábado",
            "Sunday"    => "Domingo"
        ];
        return $diaDaSemana[$day];
    }

    public function getCidadesLista($nomeCidade) {
        try{
            $urlSoap = config('app.cptec_url')."/listaCidades?city=".$nomeCidade;
            $CatalogoCidade = json_decode(json_encode(simplexml_load_file($urlSoap)), true);


            if (!is_array($CatalogoCidade)) throw new \Exception('Não foi possivel acessar a base da dados[CPTEC]');
            if (is_array($CatalogoCidade) && empty($CatalogoCidade)) throw new \Exception('Não encontramos nenhuma cidade com esse nome');


            $dsRetorno = [];
            if(!is_array($CatalogoCidade) || !isset($CatalogoCidade['cidade']) || empty($CatalogoCidade['cidade'])) {
                throw new \Exception('Não foi possivel buscar a cidade, favor tente novamente mais tarde!');
            }

            if(isset($CatalogoCidade['cidade'][0])) {
                foreach($CatalogoCidade['cidade'] as $cidade) {
                    $item = new Cidades();

                    $item->codigo = $cidade['id'];
                    $item->nome = $cidade['nome'];
                    $item->uf = $cidade['uf'];

                    $dsRetorno[] = $item;
                }
            } else {
                $item = new Cidades();
                $item->codigo = $CatalogoCidade['cidade']['id'];
                $item->nome = $CatalogoCidade['cidade']['nome'];
                $item->uf = $CatalogoCidade['cidade']['uf'];

                $dsRetorno[] = $item;
            }


            return $dsRetorno;
        } catch (\Exception $e) {
            return $e;
        }
    }

}
