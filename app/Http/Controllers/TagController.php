<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag) {
        $topics = $tag->topics()->orderBy('updated_at','desc')->simplePaginate(10);
        //dd($topics);
        return view('tags.show',compact('topics','tag'));
    }

    public function index(){
        $tags = Tag::paginate(10);
        return view('admins.tag-list',compact('tags'));
    }

    public function edit(Tag $tag){
        return view('admins.tag-edit',compact('tag'));
    }


    public function update(Tag $tag,Request $request){
        $this->validate($request,[
            'title'=>'required|min:2'
        ]);

        $tag->title = $request->title;

        $tag->save();
    }

    public function destroy(Tag $tag){
        $tag = Tag::findOrFail($tag->id);
        $tag->delete();

        return response()->json(['status'=>0,'msg'=>'删除标签成功']);

    }



    public function create(){

        return view('admins.tag-add');
    }

    public function destroyAll(Request $request){

        //json format
        $tags_list = $request->tags_list;

        $num_list=[];
        //json 格式转为数组
        foreach (json_decode($tags_list,true) as $item){
            array_push($num_list,(int)$item);
        }

        if(Tag::destroy($num_list)){
            return response()->json(['status'=>0,'msg'=>'批量删除成功']);
        }

        return response()->json(['status'=>1,'msg'=>'批量删除失败']);
    }

    public function store(Request $request,Tag $tag){
        $this->validate($request,[
            'title'=>'required|min:2',
        ]);

        $tag->title = $request->title;
        $tag->save();

    }

}
