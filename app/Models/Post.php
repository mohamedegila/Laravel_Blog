<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'cat_id',
        'title',
        'thumb',
        'full_img',
        'details',
        'tags',
        'status'

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }


    public function comments()
    {
        return $this->hasMany('App\Models\Comment')->orderBy('id', 'desc');
    }
}
