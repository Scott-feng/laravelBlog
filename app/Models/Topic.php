<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Auth;
use App\Traits\EsSearchable;

class Topic extends Model
{
    use Searchable,EsSearchable;

    protected $fillable=['title','body','category_id','view_count','user_id'];



    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }


    public function scopeRecent($query){
        return $query->orderBy('created_at','desc');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }


    public function searchableAs()
    {
        return 'topics';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return array('title' => $array['title'],'body' => $array['body']);
    }

    public function favorited()
    {
        return (bool) Favorite::where('user_id',Auth::id())
            ->where('topic_id',$this->id)
            ->first();
    }


}
