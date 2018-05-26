<?php

namespace App\Http\Controllers;

use App\UserSetting;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // @todo view
        return 'Settings';
    }

    public function store(Request $request)
    {
        UserSetting::create($request->all());

        return redirect()->route('user.settings.index');
    }
}
