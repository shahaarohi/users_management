<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UsersBlogs;

class UserBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$limit = 10;
        for ($i = 1; $i < $limit; $i++) { 

            UsersBlogs::create([ 
                'user_id' => 3,
                'blog_id' => $i

          	]); 
       	}
    }
}
