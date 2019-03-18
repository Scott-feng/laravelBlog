<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $word = $request->input('search');

        if ($word) {
            $topics = Topic::search($word)->paginate();

            return view('pages.search',compact('topics','word'));
        }
    }
}
