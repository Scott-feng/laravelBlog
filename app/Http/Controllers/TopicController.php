<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use Auth;
use App\Models\Link;
use Markdown;

class TopicController extends Controller
{
    //
    public function index(Link $link){
        $topics = Topic::with('user','category')->orderBy('updated_at','desc')
            ->paginate(10);
        $links = $link->getAllCached();


        return view('topics.index',compact('topics','links'));
    }

    public function create(Topic $topic)
    {
        $categories = Category::all();
        return view('admins.topic-add',compact('topic','categories'));
    }

    public function show(Topic $topic)
    {
        $topic->body = Markdown::driver('github')->html($topic->body);
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
        foreach (json_decode($topics_list,true) as $item){
            array_push($num_list,(int)$item);
        }

        if(Topic::destroy($num_list)){
            return response()->json(['status'=>0,'msg'=>'批量删除成功']);
        }

        return response()->json(['status'=>1,'msg'=>'批量删除失败']);
    }

    public function edit(Topic $topic){
        $categories = Category::all();
        return view('admins.topic-edit',compact('topic','categories'));
    }

    public function store(Request $request,Topic $topic){
        $this->validate($request,[
            'title'=>'required|min:2',
            'body'=>'required|min:5'
        ]);

       $topic->fill($request->all());
       $topic->user_id = Auth::id();
       $topic->save();

        return response()->json(['status'=>0,'msg'=>'添加文章成功']);
    }

    public function update(Topic $topic,Request $request){
        $this->validate($request,[
            'title'=>'required|min:2',
            'body'=>'required|min:5',
            'tags_id'=>'required',
        ]);

        $tag_list= json_decode($request->tags_id,true);

        //dd($tag_list);
        //$topic->tags()->attach($tag_list);
        $topic->tags()->sync($tag_list,true);

        $topic->title = $request->title;
        $topic->body = $request->body;
        $topic->category_id = $request->category_id;


        $topic->save();

        return response()->json(['status'=>0,'msg'=>'更新文章成功']);
    }

    public function favorites(Topic $topic)
    {
        Auth::user()->favorites()->toggle($topic->id);
        return back();
    }


    public function unFavorites(Topic $topic)
    {
        Auth::user()->favorites()->toggle($topic->id);
        return back();
    }
}
