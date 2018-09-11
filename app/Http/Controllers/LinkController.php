<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Response;


class LinkController extends Controller
{
    //
    public function index(){
        $links = Link::paginate(10);

        return view('admins.link-list',compact('links'));
    }

    public function create(){
        return view('admins.link-add');
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required|min:2',
            'link'=>'required|min:5'
        ]);

        Link::create([
           'title'=>$request->title,
           'link'=>$request->link
        ]);

        return response()->json(['status'=>0,'msg'=>'添加资源链接成功']);

    }

    public function edit(Link $link){
        return view('admins.link-edit',compact('link'));
    }

    public function update(Link $link,Request $request){
        $this->validate($request,[
            'title'=>'required|min:2',
            'link'=>'required|min:7'
        ]);

        $link->findOrFail($link->id);
        $link->title = $request->title;
        $link->link = $request->link;
        $link->save();
        return response()->json(['status'=>0,'msg'=>'更新资源链接成功']);
    }

    public function destroy(Link $link){
        $link = $link->findOrFail($link->id);

        $link->delete();

        return response()->json(['status'=>0,'msg'=>'删除资源链接成功']);
    }

    public function destroyAll(Request $request){
        $links_list = $request->links_list;

        $num_list=[];
        //json 格式转为数组
        foreach (json_decode($links_list,true) as $item){
            array_push($num_list,(int)$item);
        }

        if(Category::destroy($num_list)){
            return response()->json(['status'=>0,'msg'=>'批量删除资源链接成功']);
        }

        return response()->json(['status'=>1,'msg'=>'批量删除资源链接失败']);
    }

}
