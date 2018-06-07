<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeamsController extends Controller
{
    public function store(Request $request)
    {
        // @todo validation
        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->teams()->create([
            'name' => $request->team_name
        ]);

        auth()->login($user);

        return redirect()->route('home');
    }
}
