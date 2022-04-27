<?php

namespace Database\Factories;
use App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Blog::class;
    public function definition()
    {

            return [
                'title' => $this->faker->title, 

                'auther_name' => $this->faker->title, 

                'description' => $this->faker->text, 

                'created_at' => \Carbon\Carbon::now(), 

                'updated_at' => \Carbon\Carbon::now(), 

            ];
    }
}
