<?php


use App\Country;
use App\Role;
use App\User;
use App\UserProfile;
use App\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create();
        factory(Role::class, 5)->create();
        factory(UserProfile::class, 10)->create();
        factory(Post::class, 100)->create();
        factory(Country::class, 5)->create();
    }
}
