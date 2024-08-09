<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(12); // Adjust pagination as needed
        return view('content.user-index', compact('users'));
    }
}
