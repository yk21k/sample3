<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.Admin.{id}', function ($chat_user, $id) {
    return (int) $chat_user->id === (int) $id;
});

Broadcast::channel('sample3', function ($chat_user) {
    return Auth::check();
});
