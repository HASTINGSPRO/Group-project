<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    
    public function registerUser(Request $request) {
        //validate the request
        //username, email, phone_number, password
       $fields = $request->validate([
       'username' =>['required','max:50'], 
       'email' => ['required','max:50' ,'email','unique:users'], 
       'phone_number' => ['required','max:12'],
       'password'=> ['required','min:4', 'confirmed']
        ]); 

       //register the user
        $user = User::create($fields);

      //login 
        Auth::login($user);

       //redirect to home page
        return redirect()->route('home'); 

      
 }
  public function loginUser(Request $request){
       $fields = $request ->validate([
        'email' =>['required','max:50', 'email'],
        'password'=> ['required']
        ]); 

        //Try to login
        if(Auth::attempt($fields, $request ->remember)){
            return redirect()->intended('/');
        }else{
            return back()->withErrors([
                'failed' => 'The credentials do not match with our records'
            ]);
        }
   
}
}
