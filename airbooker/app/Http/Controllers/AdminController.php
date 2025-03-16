<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show($id) {
        $user = User::findOrFail($id);
        return view('user.profile', ['user' => $user]);
        }
}
