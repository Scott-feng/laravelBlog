<?php

namespace App\Observers;
use App\Models\Link;
use Cache;

class LinkObserver
{
    /*
    public function deleted(Topic $topic){
        \DB::table('replies')->where('topic_id',$topic->id)->delete();
    }
    */

    public function saved(Link $link){
        Cache::forget($link->cache_key);
    }
}

