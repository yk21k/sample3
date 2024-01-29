<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Validator;
use Auth;

class UserController extends Controller
{
    public function loginUser(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:250|exists:users',
                'password' => 'required|min:6'
            ],
            [
                'email.exists' => 'Email does not Exists!!'
            ]);

            if($validator->passes()){

                if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){

                    if(Auth::user()->status==0){
                        Auth::logout();
                        return response()->json(['status'=>false, 'type'=>'inactive', 'message'=>'Your Account is Not Activated Yet!!']);
                    }

                    $redirectUrl = url('cart');
                    return response()->json(['status'=>true, 'type'=>'success', 'redirectUrl'=>$redirectUrl]);
                }

            }else{
                return response()->json(['status'=>false, 'type'=>'error', 'errors'=>$validator->messages()]);

            }

        }
        return view('front.users.login');
    }

    public function registerUser(Request $request){
        if($request->ajax()){

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:150',
                'mobile' => 'required|unique:users|numeric|digits:10',
                'email' => 'required|email|max:250|unique:users',
                'password' => 'required|string|min:6'
            ],
            [
                'email.email' => 'Please enter the valid Email!!'

            ]);

            if($validator->passes()){
                $data = $request->all();
                // echo "<pre>"; print_r($data);die;

                // Register the User
                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 0;
                $user->save();

                // Activate the user only when user confirms his email account

                // Send Confirmation Email
                $email = $data['email'];
                $messageData = ['name'=>$data['name'], 'email'=>$data['email'], 'code'=>base64_encode($data['email'])];
                // Mail::send('emails.confirmation', $messageData, function($message) use($email){
                //     $message->to($email)->subject('Comfirm your Sample3 Account');
                // });

                Mail::send('emails.confirmation', $messageData, function($message) use($email){
                    $message->to($email);
                    $message->subject('Comfirm your Sample3 Account');
                });

                // Redirect back user with a success message
                $redirectURL = url('cart');
                return response()->json(['status'=>true, 'type'=>'success', 'redirectUrl'=>$redirectURL, 'message'=>'Please confirm your email to activate your Account']);

                // if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){

                //     // Send Rgister Email 
                //     $email = $data['email'];
                //     $messageData = ['name'=>$data['name'], 'mobile'=>$data['mobile'], 'email'=>$data['email']];
                //     Mail::send('emails.register', $messageData, function($message) use($email){
                //         $message->to($email)->subject('Welcome to Sample3');
                //     });

                //     $redirectUrl = url('cart');
                //     return response()->json(['status'=>true, 'type'=>'success', 'redirectUrl'=>$redirectUrl]);
                // }
            }else{
                return response()->json(['status'=>false, 'type'=>'validation', 'errors'=>$validator->messages()]);
            }   
        }
        return view('front.users.register');
    }

    public function confirmAccount($code){
        $email = base64_decode($code);
        $userCount = User::where('email', $email)->count();
        if($userCount>0){
            $userDetails = User::where('email', $email)->first();
            if($userDetails->status==1){
                // Redirect the user to login page with the error message
                return redirect('user/login')->with('error_message', 'You Account is already Activate You can Login Now!!');
            }else{
                User::where('email', $email)->update(['status'=>1]);

                // Send Welcome Email
                $messageData = ['name'=>$userDetails->name, 'mobile'=>$userDetails->mobile, 'email'=>$email];
                Mail::send('emails.register', $messageData, function($message) use($email){
                    $message->to($email)->subject('Welcome to Sample3');
                });

                // Redirect the user to the Login Page with success message
                return redirect('user/login')->with('success_message', 'Your Account is Activated. You Can Login Now!!');
            }
        }else{
            abort(404);
        }
    }

    public function logoutUser(){
        Auth::logout();
        return redirect('user/login');
    }
}
