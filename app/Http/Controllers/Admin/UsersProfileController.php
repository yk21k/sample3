<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\UserProfile;
use Session;
use Auth;

class UsersProfileController extends Controller
{
    public function usersProfile(){
        Session::put('page', 'usersProfile');
        $usersProfiles = UserProfile::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('admin.users.users_prof')->with(compact('usersProfiles'));
    }
}
