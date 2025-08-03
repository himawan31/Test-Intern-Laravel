<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        // Contoh: anggap project yang status-nya 'in_progress'
        $projects = Project::with(['tasks.assignee'])->where('status', 'ongoing')->get();

        return view('dashboard', compact('projects'));
    }
}
