<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerInquiry;
use Session;


class CustomerContactsController extends Controller
{
    public function inquiryAnswers(){
        Session::put('page', 'inquiryAnswers');
        $inquiryAnswers = CustomerInquiry::all()->sortByDesc('id');
        return view('admin.users.customer-inquiries')->with(compact('inquiryAnswers'));
    }

    public function inquiryAnswersDetails($id){
        $inquiryAnswersDetails = CustomerInquiry::all()->sortByDesc('id');
        return view('admin.users.customer-inquiries_detail')->with(compact('inquiryAnswersDetails'));
    }

}
