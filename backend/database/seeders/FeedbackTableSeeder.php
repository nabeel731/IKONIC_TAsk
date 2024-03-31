<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FeedBack;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FeedbackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::pluck('id')->toArray();

User::all()->each(function ($user) use ($categories) {
    
    
    for ($i = 0; $i <20; $i++) {
        $feedback = new Feedback();
        $feedback->user_id = $user->id;
        $feedback->title = fake()->title();
        $feedback->description = fake()->paragraph();
        $feedback->category_id = $categories[array_rand($categories)];
        $feedback->save();
    }
});
    }
}
