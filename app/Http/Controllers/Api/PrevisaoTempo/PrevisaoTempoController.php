<?php

namespace App\Http\Controllers\Api\PrevisaoTempo;

use App\Helpers\Helper;
use App\Http\Controllers\Api\ApiResponseController as BaseController;
use App\Models\PrevisaoTempo;
use Illuminate\Http\Request;

class PrevisaoTempoController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                $cidades = (new PrevisaoTempo\PrevisaoTempo())->getCidadesLista($nomeCidade);
                if($cidades instanceof \Exception) throw $cidades;
            } else {
                $cidades = (new PrevisaoTempo\PrevisaoTempo())->getCidadesLista('sao paulo');
                if($cidades instanceof \Exception) throw $cidades;
            }
            return $this->sendResponse($cidades);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
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

            return $this->sendResponse($previsao);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());

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
        return $this->sendError('ação inexistente', '', '404');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->sendError('ação inexistente', '', '404');
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
        return $this->sendError('ação inexistente', '', '404');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->sendError('ação inexistente', '', '404');
    }
}
