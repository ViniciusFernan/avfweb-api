<?php

namespace App\Http\Controllers\Api\PrevisaoTempo;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\PrevisaoTempo;
use Illuminate\Http\Request;

class PrevisaoTempoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCidades(Request $request) {
        try{
            if(!empty($request)) {
                $nomeCidade = Helper::removeAcentos($request->get('nome'));
                $cidades = (new PrevisaoTempo\Cidades())->getCidadesLista($nomeCidade);
                if($cidades instanceof \Exception) throw $cidades;
            } else {
                $cidades = (new PrevisaoTempo\Cidades())->getCidadesLista('sao paulo');
                if($cidades instanceof \Exception) throw $cidades;
            }
            return response()->json(['success'=>true,  'data' => $cidades]);
        } catch (\Exception $e) {
            return ['success'=>false,  'data' => $e->getMessage()];
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPrevisaoTempo(Request $request) {
        try{

            //Padrão codigo 244 => são paulo;
            $codigo = ($request->filled('codigo') ? $request->get('codigo') : '244');
            $previsao = (new PrevisaoTempo\PrevisaoTempo())->getPrevisaoTempoPorCidade($codigo);

            if($previsao instanceof \Exception) throw $previsao;

            return response()->json(['success'=>true,  'data' => $previsao]);
        } catch (\Exception $e) {
            return ['success'=>false,  'data' => $e->getMessage()];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
