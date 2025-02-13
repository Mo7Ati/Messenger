<?php

use App\Models\Conversation;
use App\Models\Participant;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('messenger.{id}', function ($user, $id) {
    if ((int) $user->id === (int) $id) {
        return $user;
    }
});

Broadcast::channel('messenger', function ($user) {
    return $user;
});

