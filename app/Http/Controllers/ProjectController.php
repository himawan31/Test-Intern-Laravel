<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view('manage-projects.get-project', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manage-projects.create-project');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:ongoing,completed',
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $projects = Project::findOrFail($id);
        return view('manage-projects.show-project', compact('projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        $users = User::all();
        return view('manage-projects.edit-project', compact('project', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:ongoing,completed',
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }

    public function addMember($projectId, $userId)
    {
        $project = Project::findOrFail($projectId);

        if (!$project->members->contains($userId)) {
            $project->members()->attach($userId);
        }

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function manageMembers($id)
    {
        $project = Project::with('members')->findOrFail($id);
        $users = User::all();

        return view('manage-projects.manage-member', compact('project', 'users'));
    }


    public function updateMembers(Request $request, $id)
    {
        $request->validate([
            'members' => 'nullable|array',
            'members.*' => 'exists:users,id',
        ]);

        $project = Project::findOrFail($id);
        $project->members()->sync($request->members);

        return redirect()->route('projects.index', $id)->with('success', 'Anggota proyek diperbarui.');
    }

    public function removeMember($projectId, $userId)
    {
        $project = Project::findOrFail($projectId);
        $project->members()->detach($userId);

        return redirect()->route('projects.members.manage', $projectId)
            ->with('success', 'Anggota berhasil dihapus dari proyek.');
    }
}
