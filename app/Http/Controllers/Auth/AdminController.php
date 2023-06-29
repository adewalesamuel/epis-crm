<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{   
    public function showLoginForm() {
        $data = ['title' => 'Connexion'];

        return view('admin.login', $data);
    }

    public function showForgotPasswordForm() {
        $data = ['title' => 'Mot de passe oublié'];

        return view('admin.forgot-password', $data);
    }

    public function showResetPasswordForm() {
        $data = ['title' => 'Réinitialiser le mot de passe'];

        return view('admin.new-password', $data);
    }

    public function login(Request $request) {
    	$credentials = $request->only($this->username(), 'password');

    	if (!$this->guard()->attempt($credentials)) {
            $msg = "Nom d'utilisateur ou mot de passe incorrect.";

    		return redirect(route('admin.login'))->with('error', $msg);
    	}

    	return redirect()->intended(route('admin.dashboard'));

    } 

    public function logout() {
        $this->guard()->logout();
        
        $msg = "Vous vous êtes déconnecté avec succes.";

        return redirect(route('admin.login'))->with('succes', $msg);
    	
    }

    protected function guard() {
        return Auth::guard('admin');
    }

    public function username() {
    	return 'email';
    }

}
