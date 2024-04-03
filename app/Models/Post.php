<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $guarded = false;
    protected $table = 'posts';

    protected $with = ['image','likedUsers', 'repostedPost'];

    public function image()
    {
        return $this->HasOne(PostImage::class,'post_id','id')->whereNotNull('post_id');
    }
    public function likedUsers()
    {
        return$this->belongsToMany(User::class, 'liked_posts', 'post_id', 'user_id');
    }

    public function getDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function repostedPost()
    {
        return $this->belongsTo(Post::class,'reposted_id', 'id');
    }
}
