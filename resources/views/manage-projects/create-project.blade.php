<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Project') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded-lg p-6">
            <form method="POST" action="{{ route('projects.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700" for="name">Project Name</label>
                    <input type="text" id="name" name="name"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                        value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700" for="description">Description</label>
                    <textarea id="description" name="description"
                        class="p-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700" for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                        value="{{ old('start_date') }}" required>
                    @error('start_date')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700" for="end_date">End Date</label>
                    <input type="date" id="end_date" name="end_date"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                        value="{{ old('end_date') }}" required>
                    @error('end_date')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <input type="text" name="status" value="ongoing" hidden>

                <div class="flex justify-between">
                    <a href="{{ route('projects.index') }}"
                        class="inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                        Save Project
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
