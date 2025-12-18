<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{


    // Formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }


    // Traitement de la connexion
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if(!$user->role){
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Rôle utilisateur non défini.',
                ]);
            }

            if (in_array($user->role->libelle, ['admin', 'agent'])) {
                return redirect()->route('dashboard'); // même dashboard
            } elseif ($user->role->libelle === 'demandeur') {
                return redirect()->route('welcome'); // site de demande
            }
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ]);
    }

    // Déconnexion
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
