<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function login(LoginRequest $request){
        $user=User::where('login',$request['login'])->first();
        if($user){
            if(Hash::check($request['password'],$user->password)){
                auth()->login($user);
                return redirect(route('profile_page'));
            }
            else{
                return redirect()->back()->withErrors(['Неправильно введен пароль']);
            }
        }
        return redirect()->back()->withErrors(['Такого логина не существует']);
    }
    public function logout(){
        auth()->logout();
        return redirect(route('login_page'));
    }
}
