<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    //
    function login(Request $request){

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return ['result' => 'User credentials are incorrect!', 'Success' => false];
        }

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        return['success' => true, 'result' => $success, 'message' => 'User logged in successfully'];
    }

    function signup(Request $request){
        
        $input = $request->all();

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        return['success' => true, 'result' => $success, 'message' => 'User registered successfully'];
    }
}
