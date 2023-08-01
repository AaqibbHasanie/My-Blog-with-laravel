<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    protected $fillable = [ 'title', 'body', 'user_id' ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class); // this post belongs to a user
    }
     public function tags()
    {
        return $this->belongsToMany(tags::class, 'post_tag', 'post_id', 'tag_id');
    }
}

