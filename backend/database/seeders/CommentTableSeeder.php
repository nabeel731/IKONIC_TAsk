<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\FeedBack;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feedbacks = FeedBack::pluck('id')->toArray();

     User::all()->each(function ($user) use ($feedbacks) {
    
    
    for ($i = 0; $i <20; $i++) {
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->comments = Str::random(30);
        $comment->feed_back_id = $feedbacks[array_rand($feedbacks)];
        $comment->save();
    }
});
    }
}
