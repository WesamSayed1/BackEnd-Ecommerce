<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tags extends Model
{
        protected $fillable = ['tag_title'];
      
        public function products()
        {
    	return $this->belongsToMany(Product::class,'product_tags','tag_id','product_id');
    	}

    	
}
