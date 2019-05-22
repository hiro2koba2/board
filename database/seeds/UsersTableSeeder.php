<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Post;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ユーザー10人、一人につき3ポスト生成
        factory(User::class, 10)
            ->create()
            ->each(function($user){
                $posts = factory(Post::class, 3)->make();
                $user->posts()->saveMany($posts);
            });
    }
}
