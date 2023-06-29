<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Abonnement;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ClientController extends Controller
{
    public function showLoginForm() {
        $data = ['title' => 'Connexion'];

        return view('client.login', $data);
    }

    public function showForgotPasswordForm() {
        $data = ['title' => 'Mot de passe oublié'];

        return view('client.forgot-password', $data);
    }

    public function showResetPasswordForm() {
        $data = ['title' => 'Réinitialiser le mot de passe'];

        return view('client.new-password', $data);
    }

    public function login(Request $request) {
    	$credentials = $request->only($this->username(), 'password');

    	if (!$this->guard()->attempt($credentials)) {
            $msg = "Nom d'utilisateur ou mot de passe incorrect.";

    		return redirect(route('client.login'))->with('error', $msg);
        }


        return redirect('/');

    }

    public function logout() {
        $this->guard()->logout();

        $msg = "Vous vous êtes déconnecté avec succes.";

        return redirect(route('client.login'))->with('succes', $msg);

    }

    protected function guard() {
        return Auth::guard('client');
    }

    public function username() {
    	return 'email';
    }
    public function getId(Request $request)
    {
        $credentials =$request->only($this->username(), 'password');
        $data = DB::table('clients')->select('id')->where('email','=',$credentials['email'])->get();
        $id = ['xxx'=>$data[0]->id];
        return $id;
    }





}
