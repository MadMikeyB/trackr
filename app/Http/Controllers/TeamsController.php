<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeamsController extends Controller
{
    public function create()
    {
        if (auth()->check()) {
            return 'Create Team';
        } else {
            return 'Sign Up';
        }
    }

    public function store(Request $request)
    {
        // @todo validation
        $user = auth()->user();

        if (!$user) {
            $user = User::create([
                'name' => $request->user_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }

        $user->teams()->create([
            'name' => $request->team_name
        ]);

        auth()->login($user);

        return redirect()->route('home');
    }
}
