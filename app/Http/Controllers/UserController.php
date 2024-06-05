<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function loadRegister(){
        return view('frontend.register.register');
    }

    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        // Redirect to the questions page with user ID
        return redirect()->route('login.page');
    }

    public function loadLogin(){
        return view('frontend.login.login');
    }

    public function userLogin(Request $request){
        $request->validate([
            'email'=>'required|string|email',
            'password'=>'required',
        ]);
        
        $userCredential = $request->only('email','password');
        if(Auth::attempt($userCredential)){
            return redirect('/dashboard');
        }else{
            return back()->with('error','Email and Password is incorrect');
        }
    }
}