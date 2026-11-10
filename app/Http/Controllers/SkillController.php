<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkillController extends Controller
{
    // Daftar skill beserta jumlah project yang memakainya
    public function index()
    {
        return view('skills.index', [
            'skills' => Skill::withCount('projects')->orderBy('name')->get(),
        ]);
    }

    // Form edit skill
    public function edit(Skill $skill)
    {
        return view('skills.edit', compact('skill'));
    }

    // Simpan perubahan skill
    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                // Nama harus unik, kecuali untuk skill yang sedang diedit
                Rule::unique('skills', 'name')->ignore($skill->id),
            ],
        ], [
            'name.required' => 'Nama skill wajib diisi.',
            'name.max'      => 'Nama skill maksimal 100 karakter.',
            'name.unique'   => 'Nama skill sudah digunakan.',
        ]);

        $skill->update($validated);

        return redirect()
            ->route('post.skills.index')
            ->with('success', 'Skill berhasil diperbarui.');
    }
}
