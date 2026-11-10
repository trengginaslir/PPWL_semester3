<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\Project;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        // Data Skill
        $skillNames = [
            'HTML',
            'CSS',
            'JavaScript',
            'PHP',
            'Laravel',
            'Bootstrap',
            'Tailwind CSS',
            'MySQL',
            'Java',
            'Kotlin',
        ];

        // Memasukkan Skill ke database
        foreach ($skillNames as $name) {
            Skill::firstOrCreate([
                'name' => $name,
            ]);
        }

        // Menghubungkan Skill dengan Project
        $skills = Skill::all();
        $projects = Project::all();

        foreach ($projects as $index => $project) {
            // Setiap Project mendapatkan 3 Skill
            $selectedSkills = [
                $skills[$index % $skills->count()]->id,
                $skills[($index + 1) % $skills->count()]->id,
                $skills[($index + 2) % $skills->count()]->id,
            ];

            $project->skills()->syncWithoutDetaching($selectedSkills);
        }
    }
}
