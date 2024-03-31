<?php

namespace App\Http\Controllers;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getmentionuser(Request $request,UserService $userservice)
   {
    return $userservice->getmentionuser($request->input('search'));
   }
}
