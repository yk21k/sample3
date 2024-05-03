
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Vite Vue</title>
        @vite(['resources/js/app.js'])
    </head>
    <body>
        <div id="app3">Vite Vue</div>
        <div id="app2">
        @vite(['resources/js/app.js'])


          <div class="container">
              <div class="card">
                  <div class="card-header">Chats</div>
                  <div class="card-body">
                      <chat-messages :messages="messages"></chat-messages>
                  </div>
                  <div class="card-footer">
                      <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></chat-form>
                  </div>
              </div>
          </div>
        </div>
    </body>
</html>

