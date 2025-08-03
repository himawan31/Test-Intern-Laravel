<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Project Management') }}
            </h2>
            <a href="{{ route('projects.create') }}"
                class="inline-block px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition">
                + Add Project
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto md:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="w-full table-auto text-sm text-left text-gray-700">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="p-4 text-center w-12">No</th>
                            <th class="p-4">Name</th>
                            <th class="p-4">Description</th>
                            <th class="p-4">Start Date</th>
                            <th class="p-4">End Date</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-center w-48">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $index => $project)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4 text-center">{{ $index + 1 }}</td>
                                <td class="p-4">{{ $project->name }}</td>
                                <td class="p-4">{{ $project->description }}</td>
                                <td class="p-4">{{ $project->start_date }}</td>
                                <td class="p-4">{{ $project->end_date }}</td>
                                <td class="p-4">{{ $project->status }}</td>
                                <td class="p-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('projects.edit', $project) }}"
                                            class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                                            Edit
                                        </a>
                                        <a href="{{ route('projects.members.manage', $project->id) }}"
                                            class="px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600 transition">
                                            Members
                                        </a>
                                        <form method="POST" action="{{ route('projects.destroy', $project) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-gray-500">No projects found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
