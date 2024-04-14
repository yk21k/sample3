<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Message;
use App\Events\MessageSent;
use Auth;



class ChatContorller extends Controller
{   
    public function chatIndex(){
        return view('admin.chat.adminchat');
    }

    public function sendMessage(Request $request){
        // echo "<pre>"; print_r($request);die;
        // dd($request);
        $chat_user = Auth::guard('admin')->user()->name;
        // echo "<pre>"; print_r($chat_user);die;
        // dd($chat_user);


        broadcast(new MessageSent($request->get('message')))->toOthers();
        return view('admin.layout.broadcast', ['message' => $request->get('message')]);
    }

    public function receiveMessage(Request $request){
        return view('admin.layout.receive', ['message' => $request->get('message')]);

    }
        

}
