<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        factory(User::class)->create(10)->each(function (User $user) {
            $user->posts()->saveMany(factory(Post::class, mt_rand(2,6))->make());
        });
    }
}