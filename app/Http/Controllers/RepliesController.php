<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\ReplyRequest;

class RepliesController extends Controller
{
    //


    public function store(ReplyRequest $request,Reply $reply){
        $reply->content = $request->content;
        $reply->user_id = Auth::id();
        $reply->topic_id = $request->topic_id;
        $reply->save();

        return redirect()->route('topics.show',[$reply->topic])->with('success','发表回复成功');

    }

    public function destroy(Reply $reply){
        $this->authorize('destroy',$reply);
        $reply->delete();

        return redirect()->back()->with('success','删除成功');
    }
}
