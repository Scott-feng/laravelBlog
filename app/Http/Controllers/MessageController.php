<?php

namespace App\Http\Controllers;

use App\Notifications\TopicReplied;
use Illuminate\Http\Request;
use App\Models\Message;
use Auth;
use App\Models\User;

class MessageController extends Controller
{


    public function store(Request $request)
    {
        //login check
        if (!Auth::check()){
            return response()->json('login first',403);
        }
        $this->validate($request,[
            'message'=>'required|min:2',

        ]);

        $message = Message::create([
            'content'=>$request->message
        ]);

        $userId= $request->toUser;

        $user = User::find($userId);
        $user->customNotify(new TopicReplied($message));

        return response()->json('create message success',201);
    }
}
