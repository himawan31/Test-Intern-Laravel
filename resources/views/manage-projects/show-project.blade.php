<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $projects->name }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 lg:px-8 space-y-10">

            <!-- Back Button -->
            <div>
                <a href="{{ route('dashboard') }}"
                    class="inline-block px-4 py-2 bg-gray-300 text-gray-800 text-sm rounded hover:bg-gray-400 transition">
                    ← Back to Dashboard
                </a>
            </div>

            <!-- Project Info -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Project Information</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">
                    <div>
                        <strong>Description:</strong>
                        <p class="text-gray-600 mt-1">{{ $projects->description ?? 'No description provided.' }}</p>
                    </div>
                    <div>
                        <strong>Status:</strong>
                        <p class="mt-1">
                            <span
                                class="inline-block px-3 py-1 rounded-full bg-{{ $projects->status === 'completed' ? 'green' : 'yellow' }}-100 text-{{ $projects->status === 'completed' ? 'green' : 'yellow' }}-800 capitalize">
                                {{ $projects->status }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <strong>Start Date:</strong>
                        <p class="text-gray-600 mt-1">{{ $projects->start_date }}</p>
                    </div>
                    <div>
                        <strong>End Date:</strong>
                        <p class="text-gray-600 mt-1">{{ $projects->end_date }}</p>
                    </div>
                </div>
            </div>

            <!-- Members -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Project Members</h3>
                @if ($projects->members->isEmpty())
                    <p class="text-sm text-gray-500">No members assigned.</p>
                @else
                    <ul class="space-y-2">
                        @foreach ($projects->members as $member)
                            <li class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                                <div>
                                    <p class="text-sm font-medium text-gray-800">{{ $member->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $member->email }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Tasks -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tasks</h3>
                @if ($projects->tasks->isEmpty())
                    <p class="text-sm text-gray-500">No tasks added.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($projects->tasks as $task)
                            <div class="border rounded-md p-4 hover:shadow-sm transition bg-gray-50">
                                <div class="flex justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-700">{{ $task->title }}</h4>
                                        <p class="text-sm text-gray-600">{{ $task->description }}</p>
                                        <p class="text-xs text-gray-500 mt-1">Due: {{ $task->due_date }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span
                                            class="inline-block px-2 py-0.5 text-xs rounded bg-{{ $task->priority === 'high' ? 'red' : ($task->priority === 'medium' ? 'yellow' : 'green') }}-100 text-{{ $task->priority === 'high' ? 'red' : ($task->priority === 'medium' ? 'yellow' : 'green') }}-800 capitalize">
                                            {{ $task->priority }}
                                        </span>
                                        <p class="text-sm text-gray-600 mt-1">Assigned:
                                            {{ $task->assignee->name ?? '-' }}</p>
                                        <p class="text-sm text-gray-600">Status: {{ ucfirst($task->status) }}</p>
                                        <p class="text-sm text-gray-600">Note: {{ $task->comments ?? '-' }}</p>
                                    </div>
                                </div>

                                @if (auth()->id() === $task->assigned_to)
                                    <form method="POST" action="{{ route('tasks.updateProgress', $task->id) }}"
                                        class="mt-4">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="text-sm font-medium text-gray-700">Update Status</label>
                                                <select name="status" class="w-full mt-1 p-2 border rounded-md">
                                                    <option value="not_started"
                                                        {{ $task->status == 'not_started' ? 'selected' : '' }}>Not
                                                        Started</option>
                                                    <option value="ongoing"
                                                        {{ $task->status == 'ongoing' ? 'selected' : '' }}>Ongoing
                                                    </option>
                                                    <option value="completed"
                                                        {{ $task->status == 'completed' ? 'selected' : '' }}>Completed
                                                    </option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="text-sm font-medium text-gray-700">Note</label>
                                                <input type="text" name="comments" value="{{ $task->comments }}"
                                                    class="w-full mt-1 p-2 border rounded-md"
                                                    placeholder="Add a note or issue...">
                                            </div>
                                        </div>
                                        <div class="mt-4 text-right">
                                            <button type="submit"
                                                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                                Update Task
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
