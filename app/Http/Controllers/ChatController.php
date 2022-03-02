<?php

namespace App\Http\Controllers;

use App\Events\SendMessage as EventsSendMessage;
use App\Jobs\SendEmailJob;
use App\Models\Chat;
use App\Models\User;
use App\Notifications\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function getUsers(){
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('chat.chat', compact('users'));
    }

    public function room($userId){
        $user = User::findOrfail($userId);
        $messages = Chat::with(['senderUser', 'user'])->where('user_id', $userId)->orWhere('sender_id', Auth::user()->id)->get();
        // dd($messages);
        return view('chat.room', compact('user', 'messages'));
    }

    public function message(Request $request, $userId){
        $message = $request->message;
        $user = User::findOrfail($userId);
        $chatData = [
            'user_id' => $userId,
            'sender_id' => Auth::user()->id,
            'message' => $message
        ];
        $chat = new Chat();


        if($chat = $chat->create($chatData)){
            $messages = Chat::where('sender_id', Auth::user()->id)->where('user_id', $userId)->get();
            $eventdata = [
                'userName' => $user->name,
                'message' =>$chat->message,
                'messages' => $messages
            ];
            event(new EventsSendMessage($eventdata, $userId));
            $details['email'] = $user->email;
            dispatch(new SendEmailJob($details));
            return response()->json($eventdata);
        }

    }
}
