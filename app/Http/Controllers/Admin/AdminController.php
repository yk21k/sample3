<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AdminsRole;
use Auth;
use Validator;
use Hash;
use Image;
use Session;

class AdminController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|max:30'
            ];

            $customMessages = [
                'email.required' => "Email is required !!",
                'email.email' => 'Valid Email is required !!',
                'password.required' => 'Password is required !!'
            ];

            $this->validate($request, $rules, $customMessages);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password']])){
                // Remember Admin Email & Password with cookies
                if(isset($data['remember'])&&!empty($data['remember'])){
                    setcookie("email", $data['email'], time()+30);
                    setcookie("password", $data['password'], time()+30);    
                }else{
                    setcookie("email", "");
                    setcookie("password", "");
                }
                return redirect("admin/dashboard");
            }else{
                return redirect()->back()->with("error_message", "Invalid Email or Password!!");
            }
        }
        return view('admin.login');
    }

    public function dashboard(){
        Session::put('page', 'dashboard');
        // echo "<pre>"; print_r(Auth::guard('admin')->user()); die;
        return view('admin.dashboard');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updatePassword(Request $request){
        Session::put('page', 'update-password');
        if($request->isMethod('post')){
            $data = $request->all();
            // Check if current password is correct
            if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
                // Check if new password and confirm password are matching
                if($data['new_pwd']==$data['confirm_pwd']){
                    // Update new password
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                    return redirect()->back()->with('success_message', 'Password has been updated Succesfully!!');
                }else{
                    return redirect()->back()->with('error_message', 'New Password and Retype Password not Match!!');
                }
            }else{
                return redirect()->back()->with('error_message', 'Your Current Password is Incorrect !!');
            }

        }
        return view('admin.update_password');
    }

    public function checkCurrentPassword(Request $request){
        $data = $request->all();
        if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        }
    }

    public function updateDetails(Request $request){
        Session::put('page', 'update-details');
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u|max:10',
                'admin_mobile' => 'required|numeric|digits:10',
                'admin_image' => 'image',
            ];

            $customMessages = [
                'admin_name.required' => "Name is required !!",
                'admin_name.regex' => "Valid Name is required !!",
                'admin_name.max' => "Valid(max 10char) Name is required !!",
                'admin_mobile.required' => 'Mobile is required !!',
                'admin_mobile.numeric' => 'Valid Mobile(number) is required!!',
                'admin_mobile.digits' => 'Valid Mobile(10 digits) is required!!',
                'admin_image.image' => 'Valid Image is required!!',
            ];

            $this->validate($request, $rules, $customMessages);

            // Update Admin Image
            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    // Get Image extention
                    $extention = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extention;
                    $image_path = 'admin/images/photos/'.$imageName;
                    Image::make($image_tmp)->save($image_path);
                }
            }else if(!empty($data['current_image'])){
                $imageName = $data['current_image'];
            }else{
                $imageName = "";
            }

            // Update Admin Details
            Admin::where('email', Auth::guard('admin')->user()->email)->update(['name'=>$data['admin_name'], 'mobile'=>$data['admin_mobile'], 'image'=>$imageName]);
            
            return redirect()->back()->with("success_message", "Admin Details has been updated Successfully!!");

        }
        return view('admin.update_details');
    }

    public function subadmins(){
        Session::put('page', 'subadmins');
        $subadmins = Admin::where('type', 'subadmin')->get();
        return view('admin.subadmins.subadmins')->with(compact('subadmins'));
    }

    public function updateSubadminStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data);
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Admin::where('id', $data['subadmin_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'subadmin_id'=>$data['subadmin_id']]);
        }
    }

    public function addEditSubadmin(Request $request, $id=null){
        if($id==""){
            $title = "Add Subadmin";
            $subadmindata = new Admin;
            $message = "Subadmin added successfully!!";
        }else{
            $title = "Edit Subadmin";
            $subadmindata = Admin::find($id);
            $message = "Subadmin updated successfully";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if($id==""){
                $subadminCount = Admin::where('email', $data['email'])->count();
                if($subadminCount>0){
                    return redirect()->back()->with('error_message', 'Admin/Subadmin Already Exists!');
                }   
            }
            // Subadmins Validations
            $rules = [
                'name' => 'required',
                'mobile' => 'required|numeric',
                'image' => 'required',
            ];
            $customMessages = [
                'name.required' => 'Name is required',
                'mobile.required' => 'Mobile is required',
                'image.image' => 'Valid Photo is required',
            ];
            $this->validate($request, $rules, $customMessages);

            // Update Subadmin Image
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    // Get Image extention
                    $extention = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extention;
                    $image_path = 'admin/images/photos/'.$imageName;
                    Image::make($image_tmp)->save($image_path);
                }
            }else if(!empty($data['current_image'])){
                $imageName = $data['current_image'];
            }else{
                $imageName = "";
            }
            $subadmindata->image = $imageName;
            $subadmindata->name = $data['name'];
            $subadmindata->mobile = $data['mobile'];
            if($id==""){
                $subadmindata->email = $data['email'];
                $subadmindata->type = 'subadmin';
            }
            if($data['password']!=""){
                $subadmindata->password = bcrypt($data['password']);
            }
            $subadmindata->save();
            return redirect('admin/subadmins')->with('success_message', $message);
        }

        return view('admin.subadmins.add_edit_subadmin')->with(compact('title', 'subadmindata'));
    }

    public function deleteSubadmin($id){
        //Delete Sub Admin
        Admin::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Sub Admin deleted Successfully!!');
    }

    public function updateRole($id, Request $request){
        $title = "Update Subadmin Roles/Permission";

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Delete all earlier roles for Subadmin
            AdminsRole::where('subadmin_id', $id)->delete();

            // Add New roles for Subadmin
            if(isset($data['cms_pages']['view'])){
                $cms_pages_view = $data['cms_pages']['view'];
            }else{
                $cms_pages_view = 0;
            }

            if(isset($data['cms_pages']['edit'])){
                $cms_pages_edit = $data['cms_pages']['edit'];
            }else{
                $cms_pages_edit = 0;
            }

            if(isset($data['cms_pages']['full'])){
                $cms_pages_full = $data['cms_pages']['full'];
            }else{
                $cms_pages_full = 0;
            }

            $role = new AdminsRole;
            $role->subadmin_id = $id;
            $role->module = 'cms_pages';
            $role->view_access = $cms_pages_view;
            $role->edit_access = $cms_pages_edit;
            $role->full_access = $cms_pages_full;
            $role->save();

            $message = "Subadmin Roles updated Successfully!!";
            return redirect()->back()->with('success_message', $message); 

        }
        $subadminRoles = AdminsRole::where('subadmin_id', $id)->get()->toArray();
        return view('admin.subadmins.update_roles')->with(compact('title', 'id', 'subadminRoles'));
    }

}
