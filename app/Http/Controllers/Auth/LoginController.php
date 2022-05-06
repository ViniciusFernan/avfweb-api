<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use App\Models\UserRule;
use Illuminate\Support\Facades\Redirect;


/*
|--------------------------------------------------------------------------
| Login Controller
|--------------------------------------------------------------------------
*/
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request) {
        try {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->senha, 'status' => 1]))
                return redirect('/admin/dashboard');
            else
                throw new \Exception('Não foi possível realizar a verificação de usuario');

        } catch (\Exception $e) {
            return Redirect::back()->with('alertView', Helper::alertView($e->getMessage(), 2));
        }
    }

    public function logout(Request $request) {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect('login');
    }


}
