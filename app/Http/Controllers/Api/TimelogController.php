<?php

namespace App\Http\Controllers\Api;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimelogController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    
    /**
     * Store a time log for a project
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Project $project
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function store(Request $request, Project $project)
    {
        if (!auth()->user()->can('update', $project)) {
            return redirect()->route('home');
        }

        $timelog = $project->timelogs()->create([
            'user_id' => $request->user()->id,
            'number_of_seconds' => $request->number_of_seconds
        ]);
        
        if ($request->expectsJson()) {
            return response(['success' => true, 'project' => $project, 'timelog' => $timelog], 201);
        }

        return redirect()->route('projects.show', [$project]);
    }

}
