<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $guarded = [];
    protected $fillable = ['name','price','description','image'];

    public function tags(){
    	return $this->belongsToMany(Tags::class,'product_tags','product_id','tag_id');
    }
    public function getTagsIdsAttribute()
    {
        return $this->tags->pluck('id')->toArray();
    }
}
