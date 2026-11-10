<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Technology;

class DashboardController extends Controller
{
    public function index()
    {
        return view('post.dashboard', [
            'totalProjects'     => Project::count(),
            'totalCategories'   => Category::count(),
            'totalTechnologies' => Technology::count(),
            'totalSkills'       => Skill::count(),

            // Latihan 1: jumlah project berdasarkan status
            'totalPublished'    => Project::where('status', 'published')->count(),
            'totalDraft'        => Project::where('status', 'draft')->count(),

            // Latihan 1: 5 skill yang paling banyak dipakai project
            'topSkills'         => Skill::withCount('projects')
                                        ->orderByDesc('projects_count')
                                        ->take(5)
                                        ->get(),

            // Latihan 1: jumlah project pada setiap kategori
            'categories'        => Category::withCount('projects')
                                        ->orderByDesc('projects_count')
                                        ->get(),

            'latestProjects'    => Project::with('category')->latest()->take(5)->get(),
        ]);
    }
}
