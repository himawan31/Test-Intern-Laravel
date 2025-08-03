<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'start_date', 'end_date', 'status'];

    public function members()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function tasks() 
    {
        return $this->hasMany(Task::class);
    }
}
