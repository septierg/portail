<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
       /* $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);*/

        // Vérifier si l'utilisateur existe déjà
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            // Si l'utilisateur existe déjà, le connecter

            if($existingUser){
                Auth::login($existingUser);

                // Redirection vers le dashboard (car déjà lié à un business ou cours)
                return redirect()->route('dashboard');
            }

        }else{

            // Créer le nouvel utilisateur
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);
            // Redirection vers le dashboard
            return redirect()->route('dashboard');

        }
/*
        // Créer le nouvel utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        // Pré-remplir la session pour la création d'entreprise
        session([
            'business_name' => $user->name . ' Entreprise',
            'business_type' => null,
        ]);

        // Rediriger vers création d’entreprise
        return redirect()->route('businesses.create');*/


    }
}
