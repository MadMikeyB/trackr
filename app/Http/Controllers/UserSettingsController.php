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

    /**
     * Display the settings page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('users.settings');
    }

    /**
     * Store users settings
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'hourly_rate' => 'min:0'
        ]);

        $request->user()->settings->update([
            'hourly_rate' => $request->hourly_rate,
            'currency' => $request->currency
        ]);

        return redirect()->route('user.settings.index');
    }
}
