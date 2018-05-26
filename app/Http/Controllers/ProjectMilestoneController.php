<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectMilestone;
use Illuminate\Http\Request;

class ProjectMilestoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Create the project milestone
     * 
     * @return ????
     */
    public function create(Project $project)
    {
        if (!auth()->user()->can('update', $project)) {
            return redirect()->route('home');
        }

        // @todo view
        return $project;
    }

    /**
     * Store the project milestone
     * 
     * @param Request $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Project $project)
    {
        // @todo validation

        $project->milestones()->create($request->all());

        return redirect()->route('projects.show', $project);
    }

    public function edit(Request $request, Project $project)
    {
        if (!auth()->user()->can('update', $project)) {
            return redirect()->route('home');
        }

        // @todo view
    }

    public function update(Request $request, Project $project, ProjectMilestone $milestone)
    {
        if (!auth()->user()->can('update', $project)) {
            return redirect()->route('home');
        }
        // @todo validation
        
        $milestone->update($request->all());

        return redirect()->route('projects.show', $project);
    }
}
