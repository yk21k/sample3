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

    public function uploadComplete(Request $request){
        try{
            DB::beginTransaction();
            $data = UserProfile::create([
                "extension" => $request->extension,
            ]);
            DB::commit();
            // $new_name = $data->id .'.'.'jpeg';
            $new_name = $data->id .'.'. $request->extension;
            // $new_name = $data->id.'.'.$request->extension;
            // $new_name = $data->id.'.'.$data['extension'];
            $new_name2 = substr($new_name, 0, -1);
            // echo print_r($request->extension);die;
            // echo print_r($new_name);die;
            echo print_r($new_name2);die;
            // echo print_r($request->image_path);die;
            // echo print_r($data);die;
            if($request->image_path == '/images/noimage.png' || $request->image_path == '/images/noimage2.png'){

            }else{
                Storage::move($request->image_path, 'img/'.$new_name2);
            }
            return view('front.users.upload_page_complete');
        
        }catch(\Exception $e){
            DB::rollback();
            Log::error($e);
            echo 'Error', $e->getMessage(), "\n" ; die;
            exit;
        }
    }
}
