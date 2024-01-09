<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\AdminsRole;
use Auth;


class BannersController extends Controller
{
    public function banners(){
        $banners = Banner::get()->toArray();

        // Set Admin/Sub Admins Permissions for Banners
        $bannersModuleCount = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id, 'module'=>'banners'])->count();
        $bannersModule = array();
        if(Auth::guard('admin')->user()->type=="admin"){
            $bannersModule['view_access'] = 1;
            $bannersModule['edit_access'] = 1;
            $bannersModule['full_access'] = 1;
        }else if($bannersModuleCount==0){
            $message = "This feature is restricted for you !";
            return redirect('admin/dashboard')->with('error_message', $message);
        }else{
            $bannersModule = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id, 'module'=>'banners'])->first()->toArray();
        }

        return view('admin.banners.banners')->with(compact('banners', 'bannersModule'));
    }

    public function updateBannerStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data);
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Banner::where('id', $data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'banner_id'=>$data['banner_id']]);
        }
    }

    public function deleteBanner($id){
        //Get Banner Image 
        $bannerImage = Banner::where('id', $id)->first();

        // Get Banner Image Path
        $banner_image_path = 'front/images/banners/';

        // Delete Banner Image if exists in Folder
        if(file_exists($banner_image_path.$bannerImage->image)){
            unlink($banner_image_path.$bannerImage->image);
        }
        // Delete Banner Image from banners table
        Banner::where('id', $id)->delete();
        
        return redirect()->back()->with('success_message', 'Banner deleted Successfully!!');
    }
}
