<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Register(Request $request)
    {
        $request->validate([
            'name'=>['required','string'],
            'email'=>['required','string','email','unique:users'],
            'password'=>['required','string','confirmed'],
        ]);
        $user = \App\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json('OK',200);
    }

    
    public function User(Request $request)
    {
        $user = $request->user();
        $user->orders;
        $user->locations;
        $user->flakes;
        return response()->json($user,200);
    }
    public function UpdateUser(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name'=>['required','string'],
            'email'=>['required','email',"unique:users,$user->id"],
            'password'=>['nullable','confirmed'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return response()->json($user,200);
    }
    public function Logout()
    {
        $tokens = auth()->user()->tokens;
        $tokens->each(function($token){
            $token->delete();
        });
        return response()->json("OK",200);
    }    
}
