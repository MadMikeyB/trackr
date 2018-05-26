<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function store(Request $request)
    {
        // @todo validation
        $project = Project::create($request->all());

        return redirect()->route('projects.edit', $project);
    }
}
