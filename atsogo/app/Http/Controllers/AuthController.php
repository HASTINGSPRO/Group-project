<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    
    public function registerUser(Request $request) {
       $fields = $request->validate([
       'username' =>['required','max:50'], 
       'email' => ['required','max:50' ,'email','unique:users'], 
       'phone_number' => ['required','max:12'],
       'password'=> ['required','min:4', 'confirmed']
        ]); 
       //register the user
        $user = User::create($fields);

      //login user
        Auth::login($user);

       //redirect to home page
        return redirect()->route('login'); 
 }

       //login the user
    public function login(Request $request){
       $fields = $request ->validate([
        'email' =>['required','max:50', 'email'],
        'password'=> ['required']
        ]); 

        //attempt to login the user
        if(Auth::attempt($fields)){
           //redirect to home page
           return redirect()->route('home');
        }

        //login failed
        return back()->withErrors([
           'email' => 'Invalid credentials'
        ]);
    }
}
