<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ListUserController extends Controller
{
    public function listUser()
    {
        $user = User::all();
        return view('admin.list-user', [
            'user' => $user,
        ]);
    }
}
