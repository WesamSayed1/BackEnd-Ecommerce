<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTags extends Model
{
    protected $fillable = ['product_id','tag_title','tag_id'];

}
