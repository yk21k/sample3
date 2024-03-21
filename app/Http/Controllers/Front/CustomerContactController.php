<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\Models\CustomerInquiry;
use Auth;


class CustomerContactController extends Controller
{
    public function inquiryAnswer(Request $request){
        // addresskara
        if($request->ajax()){
            $validator = Validator::make($request->all(), [
                'inq_subject' => 'required|string|max:30',
                'inquiry_details' => 'required|string|max:150',
            ]);
            if($validator->passes()){
                $data = $request->all();
                // echo "<pre>"; print_r($data);die;

                $inquiryAnswer = array();
                $inquiryAnswer['user_id'] = Auth::user()->id;
                $inquiryAnswer['inq_subject'] = $data['inq_subject'];
                $inquiryAnswer['inquiry_details'] = $data['inquiry_details'];
                $inquiryAnswer['status'] = 1;

                CustomerInquiry::create($inquiryAnswer);
                return response()->json([
                    'view'=>(String)View::make('front.users.customer-inquiry')->with(compact('inquiryAnswer'))
                ]);
            }else{
                return response()->json(['type'=>'error', 'errors'=>Validator->messages()]);
            }
        }
        return view('front.users.customer-inquiry');    
    }
}
