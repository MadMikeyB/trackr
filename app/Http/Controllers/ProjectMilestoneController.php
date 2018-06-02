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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Project $project)
    {
        if (!auth()->user()->can('update', $project)) {
            return redirect()->route('home');
        }

        return view('projects.milestones.create', compact('project'));
    }

    /**
     * Store the project milestone
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $project->milestones()->create([
            'title' => $request->title,
            'user_id' => $request->user()->id ?? auth()->id(),
            'completed_at' => ((bool)$request->completed === true) ? now() : null
        ]);

        return redirect()->route('projects.show', $project);
    }

    /**
     * Edit a project milestone
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Project $project
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, Project $project, ProjectMilestone $milestone)
    {
        if (!auth()->user()->can('update', $project)) {
            return redirect()->route('home');
        }

        return view('projects.milestones.edit', compact('project', 'milestone'));
    }

    /**
     * Edit a project milestone
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Project $project
     * @param \App\ProjectMilestone $milestone
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Project $project, ProjectMilestone $milestone)
    {
        if (!auth()->user()->can('update', $project)) {
            return redirect()->route('home');
        }

        $request->validate([
            'title' => 'required'
        ]);
        
        $milestone->update([
            'title' => $request->title,
            'completed_at' => ((bool)$request->completed == true) ? now() : null
        ]);

        return redirect()->route('projects.show', $project);
    }

    /**
     * Complete project milestone
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Project $project
     * @param \App\ProjectMilestone $milestone
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete(Request $request, Project $project, ProjectMilestone $milestone)
    {
        if (!auth()->user()->can('update', $project)) {
            return redirect()->route('home');
        }

        $milestone->update([
            'completed_at' => now()
        ]);

        return redirect()->route('projects.show', $project);
    }

    /**
     * Destroy a project milestone
     *
     * @param \App\Project $project
     * @param \App\ProjectMilestone $milestone
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project, ProjectMilestone $milestone)
    {
        if (!auth()->user()->can('delete', $project)) {
            return redirect()->route('home');
        }

        $milestone->delete();

        return redirect()->route('projects.show', $project);
    }
}
