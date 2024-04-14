@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <div class="chat">
        <div class="top">
            <p>admin</p>
            <small>online</small>
        </div>
        <div class="messages">
            
            @include('admin.layout.receive', ['message' => "Hey What's Up !"])
            
            @include('admin.layout.broadcast', ['message' => "Hey What's Up !"], [])

        </div>
        <div class="bottom">
            <form>
                
                <input type="text" id="message" name="message" placeholder="Enter Message..." autocomplete="off">
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
</div>


<!-- Chat -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="{{ asset('admin/js/admin_chat.js') }}"></script>
@endsection

