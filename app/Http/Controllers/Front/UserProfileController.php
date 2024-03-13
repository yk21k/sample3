<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use App\Models\UserProfile;

class UserProfileController extends Controller
{
    public function uploadPage(){
        return view('front.users.upload_page');
    }

    public function uploadConfirm(Request $request){

            $data = $request->all();
            // dd($data);
            $validator = Validator::make($request->all(), [
                'image' => 'image|mimes:jpeg,png,jpg'
            ],[
                'image.mimes' => 'Please jpeg,png,jpg'
            ]);
            $image = $request->file('image');

            if($validator->passes()){
            
                if($image){
                    $extension = $image->getClientOriginalExtension();

                    $new_name = uniqid().".".$extension;

                    $image_name = Storage::putFileAs(
                        'public/images',$request->file('image'), $new_name
                    );
                    $image_path = 'images/'.$new_name;
                }else{
                    $new_name = 'noimage.png';
                    $extension = '0';
                    $image_path = '/images/noimage.png';
                } 
            }else{
                $image_path = '/images/noimage2.png';
                $extension = '0';
                $message = "Please jpeg,png,jpg!!!";
            }
        
        return view('front.users.upload_page_confirm')->with(compact('image_path', 'extension'));
        
    }
}
