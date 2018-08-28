<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicController extends Controller
{
    //
    public function index(){
        $topics = Topic::with('user','category')->paginate(15);
        return view('topics.index',compact('topics'));
    }

    public function create()
    {
        return view('topics.create');
    }

    public function show(Topic $topic)
    {
        return view('topics.show',compact('topic'));
    }

}
