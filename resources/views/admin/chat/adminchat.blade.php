    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Chat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


    <form method="post" action="{{ url('admin/chat-send-message') }}" onsubmit="return false;">
        メッセージ : <input type="text" id="input_message" autocomplete="off" />
        <button type="submit" class="text-white bg-blue-700 px-5 py-2">送信</button>
    </form>@csrf

    <form action="{{ url('admin/chat-send-message') }}" method="post" onsubmit="return false;">
      <div class="input-group">
        <input type="text" name="input_message" id="input_message" placeholder="Type Message ..." class="form-control" autocomplete="off">
        <span class="input-group-append">
          <button type="button" class="btn btn-warning">Send</button>
        </span>
      </div>
    </form>@csrf

    <ul class="list-disc" id="list_message">
        
    </ul>

                </div>
            </div>
        </div>
    </div>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>


    <script defer>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        const elementInputMessage = document.getElementById( "input_message" );
        
        function onsubmit_Form()
        {
            let strMessage = elementInputMessage.value;
            if( !strMessage )
            {
                return;
            }

            params = { 'message': strMessage };

            axios
                .post( '', params )
                .then( response => {
                    console.log(response);
                } )
                .catch(error => {
                    console.log(error.response)
                } );

            elementInputMessage.value = "";
        }

        window.addEventListener( "DOMContentLoaded", ()=>
        {   
            const elementListMessage = document.getElementById( "list_message" );

            
            window.Echo.private('sample3').listen( 'MessageSent', (e) =>
            {
                console.log(e.message);
                let strUsername = e.message.username;
                let strMessage = e.message.body;

                let elementLi = document.createElement( "li" );
                let elementUsername = document.createElement( "strong" );
                let elementMessage = document.createElement( "div" );
                elementUsername.textContent = strUsername;
                elementMessage.textContent = strMessage;
                elementLi.append( elementUsername );
                elementLi.append( elementMessage );
                elementListMessage.prepend( elementLi );  // リストの一番上に追加
                //elementListMessage.append( elementLi ); // リストの一番下に追加
            });
        });
    </script>