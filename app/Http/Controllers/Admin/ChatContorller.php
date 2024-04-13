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
            $chat_user = Auth::user('admin');
            $strUsername = $chat_user->name;

            $strMessage = $request->input_message('message'); 

            $message = new Message;
            $message->username = $strUsername;
            $message->body = $strMessage;

            MessageSent::dispatch($message); 

        return $request;
    }
        

}
