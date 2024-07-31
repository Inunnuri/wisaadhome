<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // menangani penyimpanan (store) pesan dalam percakapan tertentu. 
    public function store(Request $request, $conversationId)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $conversation = Conversation::findOrFail($conversationId);

        Message::create([
            'conversation_id' => $conversationId,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->route('conversations.show', $conversationId);
    }

}

// done
