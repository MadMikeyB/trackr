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
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        // @todo view
        return 'Settings';
    }

    /**
     * Store users settings
     * 
     * @param Request $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // @todo validation
        
        UserSetting::create($request->all());

        return redirect()->route('user.settings.index');
    }
}
