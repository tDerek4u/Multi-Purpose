<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //get users and create users
    public function index_create(Request $request){
        if($request->isMethod('post')){
            return    User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        }else{
            $users = User::latest()->get();

            return $users;
        }
    }
}
