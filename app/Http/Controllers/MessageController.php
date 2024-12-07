<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function login(Request $request)
    {
        $email = $request['email'];
        $user = User::where('email', $email)->first();
        if ($user != null) {
            if (Auth::attempt(['email' => $user->email, 'password' => $request['password']], $request->has('remember_me'))) {
                $token = $user->createToken('API-Token-' . $user->name);
                $user->remember_token = $token->plainTextToken;
                $user->save();
                return response()->json($user);
            }
        }
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // Broadcast the event to all listeners
        try {
            broadcast(new MessageSent($message))->toOthers();
            // Log::info("message created: " . $message);
        } catch (\Exception $e) {
            // Log::debug("broadcast: " . $e->getMessage());
        }

        return response()->json($message, 201);

    }

    public function fetchMessages($conversationId)
    {
        $messages = Message::where('conversation_id', $conversationId)
            ->with('user:id,name')
            ->latest()
            ->get();

        return response()->json(['messages' => $messages]);
    }
}
