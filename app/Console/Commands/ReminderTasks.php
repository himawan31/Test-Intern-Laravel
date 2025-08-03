<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskReminderMail;

class ReminderTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders for unfinished tasks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::where('status', '!=', 'completed')->get();

        if ($tasks->isEmpty()) {
            $this->info('No unfinished tasks to send reminders for.');
            return;
        }

        foreach ($tasks as $task) {
            if ($task->assignee && $task->assignee->email) {
                Mail::to($task->assignee->email)->queue(new TaskReminderMail($task));
            }
        }

        $this->info('Reminder emails have been queued.');
    }
}
