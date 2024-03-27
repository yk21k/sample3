<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Models\CustomerInquiry;
use App\Models\User;
use Session;
use Auth;



class CustomerContactsController extends Controller
{
    public function inquiryAnswers(){
        Session::put('page', 'inquiryAnswers');
        $inquiryAnswers = CustomerInquiry::all()->sortByDesc('user_id');
        return view('admin.users.customer-inquiries')->with(compact('inquiryAnswers'));
    }

    public function inquiryAnswersDetails(Request $request, $user_id){

        // $inquiryAnswersDetails = CustomerInquiry::where('user_id', $user_id)->get();
        $inquiryAnswersDetails = CustomerInquiry::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        // dd($inquiryAnswersDetails);

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $rules = [
                'ans_subject' => 'required|max:50',
                'answers' => 'required|max:300'
            ];

            $customMessages = [
                'ans_subject.required' => "Subject is required !!",
                'answers.required' => "Answer is required !!"
            ];

            $this->validate($request, $rules, $customMessages);
            // $id = $inquiryAnswersDetails['id'];
            // dd($inquiryAnswersDetails['id']);

            CustomerInquiry::where('id', $data['id'])->update(['user_id'=>$user_id, 'ans_subject'=>$data['ans_subject'], 'answers'=>$data['answers'], 'status'=>1]);

            // Send Confirmation Email
            $users = User::where('id', $user_id)->get(['email', 'name'])->first()->toArray();
            // dd($users); 
            // echo "<pre>"; print_r($users);die;
            $email = $users['email'];
            
            // dd($email);
            $messageData = ['name'=>$users['name'], 'email'=>$email, 'code'=>base64_encode($email)];

            Mail::send('emails.inq_ans', $messageData, function($message) use($email){
                $message->to($email);
                $message->subject('Answer QQQ');
            });
            
        }

        return view('admin.users.customer-inquiries_detail')->with(compact('inquiryAnswersDetails'));
    }



}
