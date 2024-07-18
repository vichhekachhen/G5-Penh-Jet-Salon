<?php

namespace App\Http\Controllers\API\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::All();
        return response()->json(['data'=>$messages], 200);
        // $messages = Message::where('sender_id', $request->user()->id)
        //     ->orWhere('receiver_id', $request->user()->id)
        //     ->get();
        // return response()->json($messages);
    }

    public function store(Request $request)
    {
        $message = Message::create([
            'sender_id' => $request->user()->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);
        return response()->json($message);
    }
}
