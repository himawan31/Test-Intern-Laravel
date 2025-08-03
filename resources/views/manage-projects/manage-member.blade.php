<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Project Members') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow space-y-8">
            <div>
                <h3 class="text-lg font-semibold mb-4">Add New Member</h3>

                <div class="mb-4">
                    <input type="text" id="search" placeholder="Search for members..."
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 mb-3 p-2">
                    <ul id="user-list" class="space-y-2 max-h-64 overflow-y-auto border rounded p-2">
                        @foreach ($users as $user)
                            @if (!$project->members->contains($user->id))
                                <li class="flex justify-between items-center border-b pb-2">
                                    <span>{{ $user->name }} ({{ $user->email }})</span>
                                    <form method="POST"
                                        action="{{ route('projects.members.add', [$project->id, $user->id]) }}">
                                        @csrf
                                        <button type="submit" class="text-blue-600 hover:underline">Add</button>
                                    </form>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <a href="{{ route('projects.index') }}"
                    class="inline-block mt-4 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                    Back to Project List
                </a>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-2">Members Already Added</h3>
                <ul class="space-y-2">
                    @forelse ($project->members as $member)
                        <li class="flex justify-between items-center border-b pb-2">
                            <span>{{ $member->name }} ({{ $member->email }})</span>
                            <form method="POST"
                                action="{{ route('projects.members.destroy', [$project->id, $member->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline"
                                    onclick="return confirm('Are you sure you want to delete this member?')">Hapus</button>
                            </form>
                        </li>
                    @empty
                        <li class="text-gray-500">No members yet in this project.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const userList = document.getElementById('user-list');

            searchInput.addEventListener('input', function() {
                const keyword = this.value.toLowerCase();
                const items = userList.querySelectorAll('li');

                items.forEach(item => {
                    const text = item.innerText.toLowerCase();
                    item.style.display = text.includes(keyword) ? 'flex' : 'none';
                });
            });
        });
    </script>
</x-app-layout>
