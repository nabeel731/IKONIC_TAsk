<?php

namespace App\Services;

use App\Http\Resources\UserListResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    public function getmentionuser($search)
   {
   
     $users=User::where('name', 'like', '%' . $search . '%')->get();
     return  UserListResource::collection($users);
   }
}
