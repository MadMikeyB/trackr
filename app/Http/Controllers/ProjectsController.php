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

        // @todo view
        return $projects;
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
        
        // @todo view
        return $project;
    }

    /**
     * Display the create project form
     * 
     * @return ???
     */
    public function create()
    {
        // @todo view
    }

    /**
     * Store a new project in the database
     * 
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // @todo validation
        $project = Project::create($request->all());

        return redirect()->route('projects.edit', $project);
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
        // @todo view
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

        // @todo validation

        $project->update($request->all());

        return redirect()->to($project->url());
    }
}
