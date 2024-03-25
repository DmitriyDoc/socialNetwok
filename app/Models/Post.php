<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $guarded = false;
    protected $table = 'posts';

    protected $with = ['image'];

    public function image() {
        return $this->HasOne(PostImage::class,'post_id','id')->whereNotNull('post_id');
    }
}
