<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','auther_name']; 
    public function user_blog_relation()
    {
        return $this->belongsToMany(UsersBlogs::class, 'blog_id');
    }
}
