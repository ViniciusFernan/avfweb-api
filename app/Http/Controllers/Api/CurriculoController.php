<?php

namespace App\Http\Controllers;

use App\Models\Curriculo;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;

class CurriculoController extends Controller
{

    public function __construct() {

    }

    //unico acesso não logado ao curriculo
    public function showCurriculo($slug = null) {
        try {
            if(empty($slug)) $slug = 'antonio-vinicius-fernandes';

            $curriculo = (new Curriculo)->getCurriculoFromSlug($slug);
            if($curriculo instanceof \Exception) throw $curriculo;
            if(empty($curriculo)) throw new \Exception('erro ao buscar curriculo');

            $conteudo = $curriculo->attributesToArray()['conteudo'];

            $nome = explode(' ', $conteudo->nomeCompleto);
            $sobreNome = array_pop($nome);
            $nome = implode(' ', $nome);

            $conteudoFinal = (object) array_merge((array)$conteudo, [
                'id_curriculo' => $curriculo->id_curriculo,
                'id_user' =>  $curriculo->id_user,
                'nome' => $nome,
                'sobreNome' => $sobreNome
            ]);

            //return view('frontend.curriculo', ['conteudo' => $conteudoFinal]);
            return response()->json(['success'=>true,  'data' => $conteudoFinal]);
        } catch (\Exception $e) {
            //return abort(404, $e->getMessage());
            return response()->json(['success'=>false,  'data' => $e->getMessage()]);

        }
    }

    public function index(){
        try {
            if(!Helper::hasPermission('curriculo') && !Helper::hasSuperAdmin() )
                throw new \Exception('Não ha permissão de acesso ao item');

            $curriculos = Curriculo::where('id_user', '=', Auth::user()->id_user)->paginate(1);

            return view('backend.curriculo.listCurriculo', ['curriculos' => $curriculos]);
        } catch (\Exception $e ) {
            return Redirect::back()->with('alertView', Helper::alertView($e->getMessage(),'2'));
        }
    }

    public function show($id) {
        try {
            if(!Helper::hasPermission('curriculo') && !Helper::hasSuperAdmin() )
                throw new \Exception('Não ha permissão de acesso ao recurso');

            $curriculo = (new Curriculo)->showCurriculoEdicao($id);
            $conteudo = ((!empty($curriculo)) ? $curriculo->attributesToArray()['conteudo'] : null);

            return view('backend.curriculo.editarCurriculo', ['curriculo' => $curriculo, 'conteudo' => $conteudo]);
        } catch (\Exception $e) {
            return Redirect('/admin/curriculo')->with('alertView', Helper::alertView($e->getMessage(),'2'));
        }

    }

    public function showForm() {
        try {
            if(!Helper::hasPermission('curriculo') && !Helper::hasSuperAdmin() )
                throw new \Exception('Não ha permissão de acesso ao item');

            return view('backend.curriculo.editarCurriculo', ['curriculo' => null, 'conteudo' => null]);
        } catch (\Exception $e) {
            return Redirect('/admin/dashboard')->with('alertView', Helper::alertView($e->getMessage(),'2'));
        }
    }

    public function store(Request $request) {
        try {
            if(!Helper::hasPermission('curriculo') && !Helper::hasSuperAdmin() )
                throw new \Exception('Não ha permissão de acesso ao item');

            $request->request->remove('_token');

            $validator = Validator::make($request->all(), [
                "nomeCompleto" => 'required',
                "contato" => 'required',
                "midiasSociais" => 'required',
                "estadoCivil" => 'required',
                "dataNascimento" => 'required',
                "idiomas" => 'required',
                "cep" => 'required',
                "rua" => 'required',
                "numero" => 'required',
                "bairro" => 'required',
                "cidade" => 'required',
                "uf" => 'required',
                "areaInteresse" => 'required',
                "experiencia" => 'required',
                "formacao" => 'required',
                "cursoComplementar" => 'required',
                "habilidadesAvancadas" => 'required',
            ]);
            if($validator->fails()) throw new \Exception('Dado requerido não enviado'.$validator->errors() , 3);

            $curriculo = (new Curriculo())->criarCurriculo($request->all());
            if($curriculo instanceof \Exception) throw $curriculo;

            return Redirect('/admin/curiculo')->with('alertView', Helper::alertView('Curriculo criada com sucesso','1'));

        } catch (\Exception $e ) {
            return Redirect::back()->with('alertView', Helper::alertView($e->getMessage(),'2'));
        }
    }

    public function update(Request $request, $id) {
        try {
            if(!Helper::hasPermission('curriculo') && !Helper::hasSuperAdmin() )
                throw new \Exception('Não ha permissão de acesso as item');

            $request->request->remove('_token');

            $validator = Validator::make($request->all(), [
                "nomeCompleto" => 'required',
                "contato" => 'required',
                "midiasSociais" => 'required',
                "estadoCivil" => 'required',
                "dataNascimento" => 'required',
                "idiomas" => 'required',
                "cep" => 'required',
                "rua" => 'required',
                "numero" => 'required',
                "bairro" => 'required',
                "cidade" => 'required',
                "uf" => 'required',
                "areaInteresse" => 'required',
                "experiencia" => 'required',
                "formacao" => 'required',
                "cursoComplementar" => 'required',
                "habilidadesAvancadas" => 'required',
            ]);
            if($validator->fails()) throw new \Exception('Dado requerido não enviado'.$validator->errors() , 3);

            $curriculo = (new Curriculo())->editarCurriculo($id, $request->all());
            if($curriculo instanceof \Exception) throw $curriculo;


            return Redirect::back()->with('alertView', Helper::alertView('Item alterada com sucesso','1'));

        } catch (\Exception $e ) {
            return Redirect::back()->with('alertView', Helper::alertView($e->getMessage(),'2'));
        }
    }

    public function destroy($id) {
        try {
            if(!Helper::hasPermission('curriculo') && !Helper::hasSuperAdmin() )
                throw new \Exception('Não ha permissão de acesso ao item');

            $curriculo = Curriculo::find($id);
            if($curriculo->delete())
                return Redirect('/admin/curriculo')->with('alertView', Helper::alertView('Item apagado com sucesso','1'));
            else
                throw new \Exception('Não foi possivel apagar item');


        } catch (\Exception $e) {
            return Redirect::back()->with('alertView', Helper::alertView($e->getMessage(),'2'));
        }
    }


}
