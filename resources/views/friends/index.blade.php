<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">My Friends</h2>

        @if($friends->isEmpty())
            <p class="text-gray-600 text-center">You have no friends yet.</p>
        @else
            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($friends as $friend)
                    <li class="bg-gray-100 p-4 rounded-lg shadow-md flex items-center justify-between">
                        <!-- Profile Image -->
                        <img src="{{ $friend->profile_picture ? asset('storage/' . $friend->profile_picture) : asset('images/default-avatar.png') }}"
                             alt="Profile Picture"
                             class="w-12 h-12 rounded-full border border-gray-300">

                        <!-- Friend Info -->
                        <div class="flex-1 ml-4">
                            <p class="text-lg font-medium text-gray-900">{{ $friend->name }}</p>
                            <p class="text-sm text-gray-600">{{ $friend->email }}</p>
                        </div>

                        <!-- View Profile Button -->

                        <a href="{{ route('profile.view', $friend->id) }}"
                           class="bg-gray-100 px-4 py-2 bg-gradient-to-r from-vibe-purple to-vibe-teal text-gray-800 rounded-lg font-medium hover:from-vibe-purple/80 hover:to-vibe-teal/80 focus:outline-none focus:ring-2 focus:ring-vibe-purple focus:ring-offset-2 transition duration-200">
                            {{ __('Voir') }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
