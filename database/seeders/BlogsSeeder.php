<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $blog = new Blog();
        $blog->user_id = $faker->randomNumber();
        $blog->title = $faker->title;
        $blog->image = 'default.jpg';
        $blog->category = $faker->text(15);
        $blog->content = $faker->text(500);
        $blog->save();


    }
}
