<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VotingType;
use App\Voting;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('user.profile',[
            'votings'=>Voting::all(),
            'voting_types'=>VotingType::all(),
        ]);
    }

    public function show_password_create(){
        return view('newPassword');
    }
    public function password_create(Request $request){
        return redirect()->back()->with('password',Hash::make($request['password']));
    }
}
