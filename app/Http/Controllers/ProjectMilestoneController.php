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

    /**
     * Edit a project milestone
     * 
     * @param Illuminate\Http\Request $request
     * @param App\Project $project
     * @return ???
     */
    public function edit(Request $request, Project $project)
    {
        if (!auth()->user()->can('update', $project)) {
            return redirect()->route('home');
        }

        // @todo view
    }

    /**
     * Edit a project milestone
     * 
     * @param Illuminate\Http\Request $request
     * @param App\Project $project
     * @param App\ProjectMilestone $milestone
     * @return ???
     */
    public function update(Request $request, Project $project, ProjectMilestone $milestone)
    {
        if (!auth()->user()->can('update', $project)) {
            return redirect()->route('home');
        }
        // @todo validation
        
        $milestone->update($request->all());

        return redirect()->route('projects.show', $project);
    }

    /**
     * Destroy a project milestone
     * 
     * @param App\Project $project
     * @param App\ProjectMilestone $milestone
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project, ProjectMilestone $milestone)
    {
        if (!auth()->user()->can('delete', $project)) {
            return redirect()->route('home');
        }

        $milestone->delete();

        return redirect()->route('projects.index'); 
    }
}
