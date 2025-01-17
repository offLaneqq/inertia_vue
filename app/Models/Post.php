<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'content',
        'user_id'
    ];


    protected $hidden = [
        'visibility',
        'status',
        'likes_count'
    ];

    protected function user()
    {
        return $this->belongsTo(User::class);
    }
}
