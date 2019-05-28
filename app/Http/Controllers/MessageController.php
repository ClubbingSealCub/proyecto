<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function showUserUnreadMessages(User $user)
    {
        $unread_messages = Message::where(['user_id', $user->user_id],['read', false]);
        return $unread_messages;
    }

}
