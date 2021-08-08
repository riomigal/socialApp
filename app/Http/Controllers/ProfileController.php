<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function view(string $profile_url)
    {
        $user = User::where('profile_url', $profile_url)->first();
        if ($user) {
            return view('profile.view', compact('user'));
        }
        abort(404);
    }
}