<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->seo()->setTitle('My Projects');
        $this->seo()->setDescription('Here is where you can access all of your projects to log time, create milestones etc.');
        
        $projects = auth()->user()->projects;

        return view('home', compact('projects'));
    }
}
