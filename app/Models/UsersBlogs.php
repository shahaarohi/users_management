<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersBlogs extends Model
{
    use HasFactory;

    protected $table = 'user_blog_relation';
    protected $fillable = ['user_id','blog_id']; 

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'id');
    }
    public function users()
    {
        return $this->belongsToMany(Blog::class, 'id');
    }
}
