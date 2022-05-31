<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Like;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory(10000)->create()->each(function ($user){
            $user->profile()->save(Profile::factory()->make());
            $user->posts()->saveMany(Post::factory(10)->make());
            $user->likes()->save(Like::factory()->make());

            Post::factory(10)->create()->each(function ($post){
                $post->comments()->saveMany(Comment::factory(5)->make());
            });
        });
    }
}
