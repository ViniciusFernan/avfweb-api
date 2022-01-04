<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Rule;
use App\Models\UserRule;
use Validator;

class UserController extends Controller
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

        if(Helper::hasPermission('usuarios') || Helper::hasSuperAdmin())
            $this->user = User::paginate(15);
        else
            $this->user = User::where('id_user', '=', Auth::user()->id_user)->paginate(1);

        return view('backend.usuario.listaUsuario', ['users' => $this->user]);
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

        if(!Helper::hasPermission('usuarios') || Helper::hasSuperAdmin())
            $id = Auth::user()->id_user;

        return view(
            'backend.usuario.editarUsuario',
                [
                    'user' => User::findOrFail($id),
                    'user_rule' => UserRule::where('id_user', '=', $id)->get(),
                    'rules' => Rule::all()
                ]
        );
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


            $this->user = User::find($id);
            $this->user->fill($userData);
            $this->user->save();

            return Redirect::back()->with('alertView', Helper::alertView('Usuario Editado com sucesso'));

        } catch (\Exception $e) {
            $code = !empty($e->getCode()) ? $e->getCode() : 0;
            return Redirect::back()->with('alertView', Helper::alertView($e->getMessage(), $code));
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

            if($id != Auth::user()->id_user)
                return Redirect('/login')->with('alertView', Helper::alertView('Seu usuario foi apagad com sucesso, não há como recupera-lo','1'));
            else if($this->user->save())
                return Redirect('/admin/usuario')->with('alertView', Helper::alertView('Rule apagada com sucesso','1'));
            else
                throw new Exception('Não foi possivel apagar regra');

        } catch (\Exception $e) {
            return Redirect::back()->with('alertView', Helper::alertView($e->getMessage(),'2'));
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

            if($userRule->insert($dataSet))
                return Redirect::back()->with('alertView', Helper::alertView('Rules adicionada ao usuario com sucesso','1'));
            else
                throw new Exception('Não foi possivel adicionar regra');


        } catch (\Exception $e) {
            return Redirect::back()->with('alertView', Helper::alertView($e->getMessage(),'2'));
        }
    }
}
