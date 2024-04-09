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
        $user = Auth::user('admin');

        $message = $user->messages()->create([
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($user, $message))->toOthers();
        // MessageSent::dispatch($user, $message)

        return ['status' => 'Message Sent!'];
    }
        

}
