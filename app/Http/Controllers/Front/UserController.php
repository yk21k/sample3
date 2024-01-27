<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function loginUser(){
        return view('front.users.login');
    }

    public function registerUser(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;

            // Register the User
            $user = new User;
            $user->name = $data['name'];
            $user->mobile = $data['mobile'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->status = 1;
            $user->save();

            if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
                $redirectUrl = url('cart');
                return response()->json(['redirectUrl'=>$redirectUrl]);
            }
            
        }
        return view('front.users.register');
    }
}
