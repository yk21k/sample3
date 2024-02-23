<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Country;
use Validator;
use Auth;
use Hash;

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

                    // Remember User Email and Password
                    if(!empty($data['remember-me'])){
                        setcookie("user-email", $data['email'], time()+3600);
                        setcookie("user-password", $data['password'], time()+3600);
                    }else{
                        setcookie("user-email");
                        setcookie("user-password");
                    }

                    if(Auth::user()->status==0){
                        Auth::logout();
                        return response()->json(['status'=>false, 'type'=>'inactive', 'message'=>'Your Account is Not Activated Yet!!']);
                    }

                    $redirectUrl = url('cart');
                    return response()->json(['status'=>true, 'type'=>'success', 'redirectUrl'=>$redirectUrl]);
                }else{
                    return response()->json(['status'=>false, 'type'=>'incorrect', 'message'=>'Excuse Me, You have entered wrong password!']);
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
                'name' => 'required|string|max:150|unique:users',
                'mobile' => 'required|unique:users|numeric|digits:10|unique:users',
                'email' => 'required|email|max:250|unique:users',
                'password' => 'required|string|min:6'
            ],
            [
                'email.email' => 'Please enter the valid Email!!',
                'email.unique' => 'That Email Address is no longer available.',
                'mobile.unique' => 'That Mobile Number is no longer available.',
                'name.unique' => 'That Name is no longer available.'
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

    public function forgotPassword(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:250|exists:users',
            ],
            [
                'email.exists' => 'Email does not Exists!!'
            ]);

            if($validator->passes()){
                // Send Email to User with Reset Password link
                $email = $data['email'];
                $messageData = ['email'=>$data['email'], 'code'=>base64_encode($data['email'])];

                Mail::send('emails.reset_password', $messageData, function($message) use($email){
                    $message->to($email)->subject('Reset Your Password - Sample3');
                });

                // Show success message
                return response()->json(['type'=>'success', 'message'=>'Reset Password link sent to your registered email.']);
            }else{
                return response()->json(['status'=>false, 'type'=>'error', 'errors'=>$validator->messages()]);
            }

        }else{
            return view('front.users.forgot_password');
        }
    }

    public function resetPassword(Request $request, $code=null){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $email = base64_decode($data['code']);
            $userCount = User::where('email', $email)->count();
            if($userCount>0){
                // Update New Password
                User::where('email', $email)->update(['password'=>bcrypt($data['password'])]);

                // Send Confirmation Email to User
                $messageData = ['email'=>$email];
                Mail::send('emails.new_password_confirmation', $messageData, function($message) use($email){
                    $message->to($email)->subject('Password Updated - Sample3');
                });

                // Show success message
                return response()->json(['type'=>'success', 'message'=>'Password Reset for Your Account You can Login Now!!']);
            }else{
                abort(404);
            }
        }else{
            return view('front.users.reset_password')->with(compact('code'));
        }    
    }

    public function logoutUser(){
        Auth::logout();
        return redirect('user/login');
    }

    public function deleteUserAccountPage(){
        return view('front.users.delete-page');
    }

    public function deleteUserAccount(){
        $user = Auth::user();
        $user->delete();
        Auth::logout();
        return redirect('user/login')->with('success_message', 'The withdrawal process has been completed.');
    }

    public function account(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;    

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:150',
                'city' => 'required|string|max:150',
                'state' => 'required|string|max:150',
                'address' => 'required|string|max:150',
                'pincode' => 'required|string|max:150',
                'country' => 'required|string|max:150',
                'mobile' => 'required|numeric|digits:10',
            ]);

            if($validator->passes()){
                // Update User Details
                User::where('id', Auth::user()->id)->update(['name'=>$data['name'], 'address'=>$data['address'], 'city'=>$data['city'], 'state'=>$data['state'], 'country'=>$data['country'], 'pincode'=>$data['pincode'], 'mobile'=>$data['mobile']]);

                // Redirect back user with success message
                return response()->json(['status'=>true, 'type'=>'success', 'message'=>'User Details Successfully updated!']);

            }else{
                return response()->json(['status'=>false, 'type'=>'validation', 'errors'=>$validator->messages()]);
            }
        }else{
            $countries = Country::where('status', 1)->get()->toArray();
            return view('front.users.account')->with(compact('countries'));
        }
    }

    public function updatePassword(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;    

            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|same:new_password',
            ]);

            if($validator->passes()){

                // Entered by the User in Update Password Form
                $current_password = $data['current_password'];

                // Get Current Password from users table
                $checkPassword = User::where('id', Auth::user()->id)->first();

                // Compare Current Password
                if(Hash::check($current_password, $checkPassword->password)){

                    // Update User Current Password
                    $user = User::find(Auth::user()->id);
                    $user->password = bcrypt($data['new_password']);
                    $user->save();

                    // Redirect back user with success meesage
                    return response()->json(['type'=>'success', 'message'=>'Your Password is Successfully Updated!']);

                }else{
                    // Redirect back user with error meesage
                    return response()->json(['type'=>'incorrect', 'message'=>'Your Current Password is Incorrect!']);
                }
            }else{
                return response()->json(['type'=>'error', 'errors'=>$validator->messages()]);
            }

        }else{
            return view('front.users.update_password');
        }
    }
}
