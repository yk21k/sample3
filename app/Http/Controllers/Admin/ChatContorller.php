<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Message;
use App\Events\MessageSent;
use Auth;



class ChatContorller extends Controller
{
    public function sendMessage(Request $request){
        if($request->isMethod('post')){
            // echo "<pre>"; print_r($request);die;
            // dd($request);

            $chat_user = Auth::guard('admin');
            $strUsername = $chat_user->name;
            $strMessage = $request->input_message;
            // echo "<pre>"; print_r($strMessage);die;
            // echo "<pre>"; print_r($chat_user);die;
            // dd($chat_user);


            $message = new Message;
            $message->username = $strUsername;
            $message->body = $strMessage;

            MessageSent::dispatch($message);
        }
        // return view('admin.adminchat');
        return view('admin.chat.adminchat')->with(compact('request'));
        // return $request;
        // broadcast( new MessageSent($message))->toOthers();
        // return ['message' => $strMessage, 'user' => $strUsername];
        
        // return view('admin.adminchat')->with(['message' => $strMessage, 'user' => $strUsername]);
    }
}
