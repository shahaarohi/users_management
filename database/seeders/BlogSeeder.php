<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;


class BlogSeeder extends Seeder 

{ 

    /** 

     * Run the database seeds. 

     * 

     * @return void 

     */ 

    public function run() 

    { 

        $faker = Faker\Factory::create(); 

 

        $limit = 50; 

 

        for ($i = 0; $i < $limit; $i++) { 

            Blog::create([ 

                'name' => $faker->sentence($nbWords = 6, $variableNbWords = true), 

                'auther_name' => $faker->name, 

                'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true), 

                'created_at' => \Carbon\Carbon::now(), 

                'updated_at' => \Carbon\Carbon::now(), 

            ]); 

        } 

    } 

} 