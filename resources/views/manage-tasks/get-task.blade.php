<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Management') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto space-y-10">

            @forelse ($projects as $project)
                <div class="bg-white shadow-md rounded-lg p-6 space-y-4">

                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $project->name }}</h3>
                        <a href="{{ route('tasks.create', $project->id) }}"
                            class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
                            + Add Task
                        </a>
                    </div>

                    @if ($project->tasks->isEmpty())
                        <p class="text-gray-500 text-sm">No tasks available for this project.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="table-fixed w-full text-sm text-left text-gray-800">
                                <thead class="bg-gray-100 text-gray-700">
                                    <tr>
                                        <th class="w-7 px-2 py-2">Title</th>
                                        <th class="w-10 px-2 py-2">Description</th>
                                        <th class="w-2 px-2 py-2">Due Date</th>
                                        <th class="w-2 px-2 py-2">Priority</th>
                                        <th class="w-5 px-2 py-2">Assigned To</th>
                                        <th class="w-1 px-2 py-2">Status</th>
                                        <th class="w-1 px-2 py-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($project->tasks as $task)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-2 py-2 truncate">{{ $task->title }}</td>
                                            <td class="px-2 py-2 truncate">{{ $task->description }}</td>
                                            <td class="px-2 py-2">{{ $task->due_date }}</td>
                                            <td class="px-2 py-2 capitalize">{{ $task->priority }}</td>
                                            <td class="px-2 py-2 truncate">{{ $task->assignee->name ?? '-' }}</td>
                                            <td class="px-2 py-2 capitalize">{{ $task->status }}</td>
                                            <td class="px-2 py-2 text-center space-x-2">
                                                <a href="{{ route('tasks.edit', $task->id) }}"
                                                    class="text-blue-600 hover:underline">Edit</a>
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                    class="inline-block"
                                                    onsubmit="return confirm('Are you sure you want to delete this task?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:underline">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            @empty
                <p class="text-gray-500 text-sm text-center">No projects found.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>
