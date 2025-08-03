<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-fit">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-2xl font-semibold text-gray-700 mb-8">Projects in Progress</h3>

            @if ($projects->isEmpty())
                <div class="text-center text-gray-500 text-sm mt-10">
                    No ongoing projects available at the moment.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($projects as $project)
                        <a href="{{ route('projects.show', $project->id) }}"
                            class="block bg-white shadow-md rounded-lg overflow-hidden transition hover:shadow-xl hover:ring-2 hover:ring-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <div class="bg-slate-500 px-5 py-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-lg font-bold text-white">{{ $project->name }}</h4>
                                        <p class="text-sm text-slate-100 mt-1">
                                            {{ $project->description ?? 'No description available.' }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <span
                                            class="inline-block px-2 py-1 text-xs font-medium rounded bg-blue-100 text-blue-800 capitalize">
                                            {{ str_replace('_', ' ', $project->status) }}
                                        </span>
                                        <p class="text-xs text-white mt-1">
                                            {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }} –
                                            {{ \Carbon\Carbon::parse($project->end_date)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @php
                                $tasks = $project->tasks->where('status', '!=', 'completed');
                            @endphp

                            @if ($tasks->isEmpty())
                                <div class="px-5 py-4 text-gray-500 text-sm">
                                    No unfinished tasks for this project.
                                </div>
                            @else
                                <div class="px-5 py-4 divide-y divide-gray-200">
                                    @foreach ($tasks as $task)
                                        <div class="py-3">
                                            <div class="flex justify-between">
                                                <div>
                                                    <h5 class="text-base font-semibold text-gray-800">
                                                        {{ $task->title }}</h5>
                                                    <p class="text-sm text-gray-600">{{ $task->description }}</p>
                                                    <p class="text-xs text-gray-500 mt-1">Due: {{ $task->due_date }}</p>
                                                </div>
                                                <div class="text-right text-sm space-y-1">
                                                    <span
                                                        class="inline-block px-2 py-1 text-xs font-semibold rounded 
                                    {{ $task->status === 'not_started'
                                        ? 'bg-red-100 text-red-800'
                                        : ($task->status === 'ongoing'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-green-100 text-green-800') }}">
                                                        {{ ucfirst($task->status) }}
                                                    </span>
                                                    <p class="text-gray-600 text-xs">Assigned:<br>
                                                        <span
                                                            class="font-medium">{{ $task->assignee->name ?? '-' }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
