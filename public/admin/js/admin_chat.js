// $(document).ready(function(){
// 	// Chat
// 	const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {cluster:'ap3'});
// 	const channel = pusher.subscribe('public');

// 	// Receive messages
// 	channel.bind('chat', function(data){
// 	$.post("/admin/chat-receive-message", {
// 	  _token: '{{ csrf_token() }}',
// 	  message: data.message,
// 	  chatname: data.chatname,
// 	})
// 	  .done(function(res){
// 	    $(".messages > .message").last().after(res);
// 	    $(document).scrollTop($(document).height());
// 	  });
// 	});

// 	// Broadcast message
// 	$("form").submit(function(event){
// 	event.preventDefault();

// 		$.ajax({
// 		  url: "/admin/chat-send-message",
// 		  timeout:30000,
// 		  method: 'post',
// 		  headers: {
// 		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 		      },
// 		  data: {
// 		    _token: '{{ csrf_token() }}',
// 		    message: $("form #message").val(),
// 		    chatname:$("form .chatname").val(),
// 		  },
// 		  dataType: "json",
// 		}).done(function(res){
// 		    $(".messages > .message").last().after(res);
// 		    $("form #message").val('');
// 		    $("form #chatname").val('');

// 		    $(document).scrollTop($(document).height());

// 		});
// 	});

// });
