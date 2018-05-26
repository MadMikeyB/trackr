<?php

namespace App\Http\Controllers;

use App\UserSetting;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    public function store(Request $request)
    {
        UserSetting::create($request->all());

        return redirect()->route('user.settings.index');
    }
}
