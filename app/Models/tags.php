<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tags extends Model
{
    protected $fillable = ['name'];
    use HasFactory;

    public function posts()
{
    return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id');
}

}
