<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Topic extends Model
{
    use Searchable;
    //
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
        return 'topics_index';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return array('title' => $array['title'],'body' => $array['body']);
    }

}
