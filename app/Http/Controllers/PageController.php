<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class PageController extends Controller
{
    //

    public function home(){
        return view('pages.home');
    }

    public function provide(){
        $category = Category::all()->paginate(5);

        return view('layouts._header',compact('category'));

    }
}
