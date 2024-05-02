@extends('admin.layout.layout')
@section('content')

<!DOCTYPE html>
<head>
  <title>Pusher Test</title>

  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head>
<body>
  <div class="content-wrapper">  
  <h1>Pusher Test</h1>
  <p>
    Publish an event to channel <code>my-channel</code>
    with event name <code>my-event</code>; it will appear below:
  </p>


    <!-- resources/views/chat.blade.php -->
    
    <div class="container" id="app">
        <div class="card">
            <div class="card-header">Chats</div>
                <div class="chat">
                    <div class="card-body">

                        <div class="messages">
                            @include('admin.layout.receive', ['message' => "Hey! What's up!  👋"])
                            @include('admin.layout.receive', ['message' => "Ask a friend to open this link and you can chat with them!"])
                        </div>
                    </div>
                    <div class="card-footer">
                        <form>
                            <input type="text" id="user" name="user" value="{{ Auth::guard('admin')->user()->name }}" readonly>
                            <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                            <button type="submit">Send</button>
                        </form>
                    </div>
                </div>    
        </div>
    </div>
    <script>
      const pusher  = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'ap3'});
      const channel = pusher.subscribe('public');

      //Receive messages
      channel.bind('chat', function (data) {
        $.post("chat-receive-message", {
          _token:  '{{csrf_token()}}',
          message: data.message,
        })
         .done(function (res) {
           $(".messages > .message").last().after(res);
           $(document).scrollTop($(document).height());
         });
      });

      //Broadcast messages
      $("form").submit(function (event) {
        event.preventDefault();

        $.ajax({
          url:     "chat-send-message",
          method:  'POST',
          headers: {
            'X-Socket-Id': pusher.connection.socket_id
          },
          data:    {
            _token:  '{{csrf_token()}}',
            message: $("form #message").val(),
            user: $("form #user").val(),
          }
        }).done(function (res) {
          $(".messages > .message").last().after(res);
          $("form #message").val('');
          $("form #user").val('');
          $(document).scrollTop($(document).height());
        });
      });

    </script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</div>  
@endsection

