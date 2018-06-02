<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Instantiate a new ProjectsController
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a list of the currently authenticated users projects
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->seo()->setTitle('My Projects');
        $this->seo()->setDescription('Here is where you can access all of your projects to log time, create milestones etc.');
        
        $projects = auth()->user()->projects;

        return view('home', compact('projects'));
    }

    /**
     * Show a single project
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(Project $project)
    {
        if (!auth()->user()->can('view', $project)) {
            return redirect()->route('home');
        }

        $this->seo()->setTitle($project->title);
        $this->seo()->setDescription($project->description);

        return view('projects.show', compact('project'));
    }

    /**
     * Display the create project form
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        $this->seo()->setTitle('Create Project');
        $this->seo()->setDescription('Once your project is created, you can log time against it, add milestones, and see how much time you have left.');

        return view('projects.create');
    }

    /**
     * Store a new project in the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|min:4',
            'total_seconds' => 'required|integer|min:0'
        ]);

        $project = auth()->user()->projects()->create($request->all());

        return redirect()->route('projects.show', [$project]);
    }

    /**
     * Edit a Project
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Project $project)
    {
        if (!auth()->user()->can('update', $project)) {
            return redirect()->route('home');
        }
        
        $this->seo()->setTitle('Update Project: '. $project->title);
        $this->seo()->setDescription($project->description);


        return view('projects.edit', compact('project'));
    }

    /**
     * Update a project
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Project $project)
    {
        if (!auth()->user()->can('update', $project)) {
            return redirect()->route('home');
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required|min:4',
            'total_seconds' => 'required|integer|min:0'
        ]);

        $project->update($request->all());

        return redirect()->to($project->url());
    }

    /**
     * Delete a project
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project)
    {
        if (!auth()->user()->can('delete', $project)) {
            return redirect()->route('home');
        }

        $project->delete();

        return redirect()->route('projects.index');
    }
}
