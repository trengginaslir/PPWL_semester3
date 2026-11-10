<?php

namespace App\Http\Controllers;

use App\Models\Project;

class PortfolioController extends Controller
{
    public function home()
    {
        return view('portfolio.home', [
            'projects' => Project::latest()->get(),
        ]);
    }

    public function projects()
    {
        return view('portfolio.projects', [
            'projects' => Project::with('category')->latest()->get(),
        ]);
    }

    public function show(Project $project)
    {
        $project->load(['category', 'images']);

        return view('portfolio.project', compact('project'));
    }
}
