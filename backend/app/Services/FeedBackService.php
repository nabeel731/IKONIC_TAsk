<?php

namespace App\Services;

use App\Http\Resources\CommentResource;
use App\Http\Resources\FeedBackResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\FeedBack;

class FeedBackService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function SaveFeedback($payload)
    {
        $category = Category::where('id', $payload->category)->first();


        $feedback = FeedBack::create([
            'title' => $payload->title,
            'category_id' => $payload->category,
            'user_id' => auth()->user()->id,
            'description' => $payload->description
        ]);

        $feedbacks = FeedBack::with('user', 'comments.user','category')->where('feed_backs.id',$feedback->id)->first();
        return new  FeedBackResource($feedbacks);
    }

    public function getFeedback()
    {
        $feedbacks = FeedBack::with('user', 'comments.user','category')->paginate(10);
        return FeedBackResource::collection($feedbacks);
    }

    public function AddComment($payload)
    {
        $comment = Comment::create([
            
            'user_id' => auth()->user()->id,
            'feed_back_id' => $payload->feedback_id,
            'comments' => $payload->comment,
        ]);

        $comments=Comment::with('user')->where('comments.id',$comment->id)->first();
        return new CommentResource($comments);




    }
}
