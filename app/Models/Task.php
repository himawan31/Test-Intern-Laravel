<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'due_date', 'status', 'project_id', 'priority', 'assigned_to', 'comments'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
