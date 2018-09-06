<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicController extends Controller
{
    //
    public function index(){
        $topics = Topic::with('user','category')->paginate(10);
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

    public function adminIndex(){
        $topics = Topic::with('user','category')->paginate(10);
        return view('admins.topic-list',compact('topics'));
    }

    public function destroy(Topic $topic){
        $topic = Topic::findOrFail($topic->id);
        $topic->delete();

        return response()->json(['status'=>0,'msg'=>'删除文章成功']);


    }

    public function destroyAll(Request $request){

        //json format
        $topics_list = $request->topics_list;

        $num_list=[];
        //json 格式转为数组
        foreach (json_decode($topics_list) as $item){
            array_push($num_list,(int)$item);
        }

        if(Topic::destroy($num_list)){
            return response()->json(['status'=>0,'msg'=>'批量删除成功']);
        }

        return response()->json(['status'=>1,'msg'=>'批量删除失败']);
    }

}
