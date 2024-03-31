<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserListResource;
use App\Models\User;
use App\Services\FeedBackService;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;


class FeedBackController extends Controller
{

   public function store(Request $request,FeedBackService $feedbackservice) {

    $request->validate( [
        'title' => 'required|string|max:250',
        'category' => 'required',
        'description' => 'required|string'
    ]);

    return $feedbackservice->SaveFeedback($request);
   }

   


   public function index(FeedBackService $feedbackservice) {

    

    return $feedbackservice->getFeedback();
   }

   public function AddComment(Request $request,FeedBackService $feedbackservice)
   {
    $request->validate( [
        'feedback_id' => 'required',
        'comment' => 'required',
    ]);
    return $feedbackservice->AddComment($request);
    
   }

}