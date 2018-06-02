<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class TimelogController extends Controller
{
    /**
     * Instantiate a new TimelogController
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * View the timelogs for a project (used for pop up window)
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(Project $project)
    {
        if (!auth()->user()->can('view', $project)) {
            return redirect()->route('home');
        }

        return view('projects.timelogs.show', compact('project'));
    }
}
