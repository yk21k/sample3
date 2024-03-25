<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerInquiry;
use Session;
use Auth;



class CustomerContactsController extends Controller
{
    public function inquiryAnswers(){
        Session::put('page', 'inquiryAnswers');
        $inquiryAnswers = CustomerInquiry::all()->sortByDesc('user_id');
        return view('admin.users.customer-inquiries')->with(compact('inquiryAnswers'));
    }

    public function inquiryAnswersDetails($user_id){

        // $inquiryAnswersDetails = CustomerInquiry::where('user_id', $user_id)->get();
        $inquiryAnswersDetails = CustomerInquiry::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        // dd($inquiryAnswersDetails);
        return view('admin.users.customer-inquiries_detail')->with(compact('inquiryAnswersDetails'));
    }

}
