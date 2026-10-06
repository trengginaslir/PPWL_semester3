<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $data = [
            'projects' => Project::all()
        ];
        return view('projects.index')->with($data);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required',
        ]);

        Project::create($request->only(['title', 'description']));

        return redirect()->route('projects.index');
    }

    public function show(string $id)
    {
        $data = [
            'projects' => Project::find($id)
        ];
        return view('projects.show')->with($data);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}