<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Response;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::paginate(10);
        return view('admins.cate-list',compact('categories'));
    }

    public function edit(Category $category){
        return view('admins.cate-edit',compact('category'));
    }

    public function update(Category $category,Request $request){
        $this->validate($request,[
            'name'=>'required|min:2',
            'description'=>'required|min:2'
        ]);

        $category->findOrFail($category->id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return response()->json(['status'=>0,'msg'=>'更新成功']);
    }

    public function create(){

        return view('admins.cate-add');
    }

    public function store(Request $request){
        $this->validate($request,[
           'name'=>'required|min:2',
           'description'=>'required|min:2'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json(['status'=>0,'msg'=>'创建分类成功']);
    }


    public function destroy(Category $category){
        $category = Category::findOrFail($category->id);
        $category->delete();
        return response()->json(['status'=>0,'msg'=>'删除成功']);
    }

    public function destroyAll(Request $request){
        $categories_list = $request->categories_list;

        $num_list=[];
        //json 格式转为数组
        foreach (json_decode($categories_list) as $item){
            array_push($num_list,(int)$item);
        }

        if(Category::destroy($num_list)){
            return response()->json(['status'=>0,'msg'=>'批量删除成功']);
        }

        return response()->json(['status'=>1,'msg'=>'批量删除失败']);
    }


}
