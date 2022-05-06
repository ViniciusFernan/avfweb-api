<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\ApiResponseController;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Usuario;
//use App\Models\Rule;
use App\Models\UserRule;
use Validator;

class UsuarioController extends ApiResponseController
{

    protected $user;

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try{

            if(Helper::hasPermission('usuarios') || Helper::hasSuperAdmin())
                $this->user = Usuario::paginate(15);
            else
                $this->user = Usuario::where('id_user', '=', Auth::user()->id_user)->paginate(1);

            return $this->sendResponse(['users' => $this->user]);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try{

            if(!Helper::hasPermission('usuarios') || Helper::hasSuperAdmin())
                $id = Auth::user()->id_user;

            $data = [
                'user' => Usuario::findOrFail($id),
                'user_rule' => UserRule::where('id_user', '=', $id)->get(),
                'rules' => Rule::all()
            ];

            return $this->sendResponse($data);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {
            //se não tiver permisão de administrar usuarios e estiver tentando alterar um usuario que não seja o seu (LOGADO) mensagem de erro
            if(!Helper::hasPermission('usuarios') &&  !Helper::hasSuperAdmin() && $id != Auth::user()->id_user)
                throw new \Exception('Erro ao atualizar usuario recarregue a pagina e tente novamente');

            $userData = array_filter($request->all());

            if(empty($userData))
                throw new \Exception('Necessário envio dealgum dado');


            $validator = Validator::make($userData, [
                'nome' => 'required',
                'email' => 'required|email',
                'telefone' => 'required',
                'sexo' => 'required',
            ]);

            if($validator->fails())
                throw new \Exception('Dado requerido não enviado'.$validator->errors() , 3);


            if (isset($userData['password']) && !empty($userData['password']))
                $userData['password'] = bcrypt($userData['password']);


            $this->user = Usuario::find($id);
            $this->user->fill($userData);
            $this->user->save();

            return $this->sendResponse('Usuario Editado com sucesso');
        } catch (\Exception $e) {
            $code = !empty($e->getCode()) ? $e->getCode() : 0;
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            //se não tiver permisão de administrar usuarios e estiver tentando alterar um usuario que não seja o seu (LOGADO) mensagem de erro
            if(!Helper::hasPermission('usuarios') && !Helper::hasSuperAdmin() && $id != Auth::user()->id_user)
                throw new \Exception('Erro ao atualizar usuario recarregue a pagina e tente novamente');

            $this->user = User::find($id);
            $this->user->fill(['status'=>'0']);

            $this->user->save();

            if($id != Auth::user()->id_user)
               $mensagem = 'Seu usuario foi apagad com sucesso, não há como recupera-lo';
            else
                throw new Exception('Não foi possivel apagar regra');

            return $this->sendResponse($mensagem);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
        }
    }

    public function storeRules(Request $request, $id) {

        try {

           $dataSet = [];
            if(!isset($request) || empty($request->all()))
                throw new Exception('Não foi possivel adicionar regra recarregue a pagina');

            if(!isset($request->all()['usuario_rules']) || empty($request->all()['usuario_rules']))
                throw new Exception('Não foi possivel adicionar regra');


            foreach ($request->all()['usuario_rules'] as $key => $rule) {
                $dataSet[] = [
                    'id_user' => $id,
                    'id_rule' => $rule
                ];
            }

            $userRule = new UserRule();

            //deletar todas as regras do usuario e recria novamente;
            //futuramente incluir dentro de uma transação separada
            $userRule->where('id_user',$id)->delete();

            if(! $userRule->insert($dataSet))
                throw new Exception('Não foi possivel adicionar regra');

            return $this->sendResponse('Rules adicionada ao usuario com sucesso');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(),$e->getTrace(),$e->getCode());
        }
    }
}
