<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerContactController extends Controller
{
    public function inquiryAnswer(Request $request){
        // addresskara
        if($request->ajax()){
            $Validator = Validator::make($request->all(), [
                'inq_subject' => 'required|string|max:30',
                'inquiry_details' => 'required|string|max:150',
                'ans_subject' => 'required|string|max:30',
                'answers' => 'required|string|max:150'
            ]);
            if($validator->passes()){
                $data = $request->all();
                $inquiryAnswer = array();
            }else{
                return response()->json(['type'=>'error', 'errors'=>Validator->messages()]);
            }
        }
        return view('front.users.customer-inquiry');    
    }
}
