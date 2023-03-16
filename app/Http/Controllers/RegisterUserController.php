<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function showForm(){
        return view('auth.register');
    }

    public function store(Request $request){
        $request->validate([
//            'name' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users',
            'mdp' => 'required|string|confirmed'//|min:8',
        ]);

        $user = new User();
        $user->login = $request->login;
        $user->mdp = Hash::make($request->mdp);
        $user->save();
   
        session()->flash('etat','User added');
 
        Auth::login($user);

        return redirect('/home');
    }

    public function createForm(){
        return view('admin.adminRegister');
    }

    public function createCookorAdmin(Request $request){
        $request->validate([
            'login' => 'required|string|max:255|unique:users',
            'mdp' => 'required|string|confirmed'//|min:8',
        ]);

        $type = $request->input('type');
        if ($type != 'admin' && $type != 'cook') {
            $request->session()->flash('error', 'Invalid user type');
            return redirect('/home');
        }

        $user = new User();
        $user->login = $request->login;
        $user->mdp = Hash::make($request->mdp);
        $user->type = $type;
        $user->save();

        $request->session()->flash('etat',' created successfuly');
        return redirect('/home');


    }
}
