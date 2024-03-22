<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikedPost extends Model
{

    protected $guarded = true;
    protected $table = 'liked_posts';
}
