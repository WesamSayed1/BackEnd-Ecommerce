<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;

class UsersController extends Controller
{
    public function index(User $users)
    {
        $users = User::all();
        return UsersResource::collection($users);
    }

    public function show($id)
    {
        $orders = Order::where('user_id', $id)->get();
        $user = User::where('id',$id)->first();
        return UsersResource::collection(User::paginate(4));
    }
}
