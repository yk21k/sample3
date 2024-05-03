<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Library\Message;
// use App\Models\Message;
use Auth;

class ChatsController extends Controller
{
    public function index()
    {
      return view('admin.chat.adminchat');
    }

    public function sendMessage(Request $request)
    {
        $message = new Message;
        $message->user = $request->user;
        $message->message    = $request->message;

        MessageSent::dispatch($request->get('message'));  
        // MessageSent::dispatch($message->get('user'));  
        // broadcast(new MessageSent($request.message))->toOthers();
        broadcast(new MessageSent($request->get('message')))->toOthers();

        return view('admin.layout.broadcast', ['message' => $request->get('message')]);
    }

    public function receiveMessage(Request $request)
    {
        return view('admin.layout.receive', ['message' => $request->get('message')]);
    }




}
