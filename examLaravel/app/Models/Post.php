<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'published_at', 'cover_image'];

    public function comments(){
        return $this->hasMany(Comment::class, 'post_id');
    }

    protected $casts = [
        'published_at' => 'datetime',
    ];



}
