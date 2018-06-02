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
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $projects = auth()->user()->projects;

        return view('home', compact('projects'));
    }

    /**
     * Show a single project
     *
     * @param App\Project $project
     * @return App\Project
     */
    public function show(Project $project)
    {
        if (!auth()->user()->can('view', $project)) {
            return redirect()->route('home');
        }

        return view('projects.show', compact('project'));
    }

    /**
     * Display the create project form
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a new project in the database
     *
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|min:4',
            'total_seconds' => 'required|integer|min:0'
        ]);

        // @todo validation
        $project = auth()->user()->projects()->create($request->all());

        return redirect()->route('projects.show', $project);
    }

    /**
     * Edit a Project
     *
     * @param App\Project $project
     * @return ????
     */
    public function edit(Project $project)
    {
        if (!auth()->user()->can('update', $project)) {
            return redirect()->route('home');
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Update a project
     *
     * @param Illuminate\Http\Request $request
     * @param App\Project $project
     * @return Illuminate\Http\RedirectResponse
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
     * @param App\Project $project
     * @return Illuminate\Http\RedirectResponse
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
