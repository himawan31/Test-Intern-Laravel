<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['tasks.assignee'])->get();
        return view('manage-tasks.get-task', compact('projects'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($projectId)
    {
        $projects = Project::findOrFail($projectId);
        $users = $projects->members;
        return view('manage-tasks.create-task', compact('projects', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $projectId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'assigned_to' => 'required|exists:users,id',
        ]);

        Task::create([
            'project_id' => $projectId,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->route('tasks.index', $projectId)->with('success', 'Task created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::with('project', 'assignee')->findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $projects = $task->project;
        $users = $projects->members;
        return view('manage-tasks.edit-task', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'assigned_to' => 'required|exists:users,id',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index', $task->project_id)->with('success', 'Task updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $projectId = $task->project_id;
        $task->delete();

        return redirect()->route('tasks.index', $projectId)->with('success', 'Task deleted');
    }

    public function updateProgress(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        // Pastikan hanya assignee yang boleh update
        if (auth()->id() !== $task->assigned_to) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'status' => 'required|in:not_started,ongoing,completed',
            'comment' => 'nullable|string|max:1000',
        ]);

        $task->update([
            'status' => $request->status,
            'comments' => $request->comments,
        ]);

        return back()->with('success', 'Task updated successfully');
    }
}
