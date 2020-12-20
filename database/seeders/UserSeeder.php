<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Administrator';
        $user->email = 'admin@nosblog.com';
        $user->password = Hash::make('12345678');
        $user->isAdmin = true;

        $user->save();

        $this->call(UserSeeder::dummymale());
        $this->call(UserSeeder::dummyfemale());
        $this->call(UserSeeder::dummymale());
        $this->call(UserSeeder::dummyfemale());
        $this->call(UserSeeder::dummymale());
        $this->call(UserSeeder::dummyfemale());
        $this->call(UserSeeder::dummymale());
        $this->call(UserSeeder::dummyfemale());
        $this->call(UserSeeder::dummymale());
        $this->call(UserSeeder::dummyfemale());
    }

    public static function dummymale()
    {
        $faker = Faker::create();

        $user = new User();
        $user->name = $faker->name('male');
        $user->email = Str::slug($user->name).'@gmail.com';
        $user->password = Hash::make('87654321');
        $user->phone_number = 254712345678;
        $user->save();

    }
    public static function dummyfemale()
    {
        $faker = Faker::create();

        $user = new User();
        $user->name = $faker->name('female');
        $user->email = Str::slug($user->name).'@gmail.com';
        $user->password = Hash::make('87654321');
        $user->phone_number = 254734125678;
        $user->save();

    }
}
