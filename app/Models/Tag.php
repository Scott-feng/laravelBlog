<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Tag extends Model
{
    use Searchable;

    protected $fillable = ['title'];

    public function topics(){
        return $this->belongsToMany(Topic::class);
    }

    public function searchableAs()
    {
        return 'tags_index';
    }


    public function toSearchableArray()
    {
        $array = $this->toArray();

        return $array;

    }

}
