<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight tracking-tight">
            {{ __('Friend Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-xl ring-1 ring-gray-200 dark:ring-gray-700 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <!-- Display Friend's Profile Info -->
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ $user->name }}</h3>
                    <img src="{{ asset('storage/' . $user->profile_picture ?? 'images/default-avatar.png') }}" alt="{{ $user->name }}'s profile picture" class="w-32 h-32 rounded-full object-cover mb-4">
                    <p class="text-base text-gray-600 dark:text-gray-400">Email: {{ $user->email }}</p>
                    <p class="text-base text-gray-600 dark:text-gray-400">Bio: {{ $user->bio ?? 'No bio available' }}</p>

                    <!-- Display if user is already friends -->
                    @if ($isFriend)
                        <p class="text-green-600 font-semibold">You are friends with this user!</p>
                    @else
                        <form action="{{ route('add_friend', ['user' => $user->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="mt-4 inline-flex items-center px-4 py-2 bg-gradient-to-r from-vibe-purple to-vibe-teal text-white rounded-lg font-medium hover:from-vibe-purple/80 hover:to-vibe-teal/80 focus:outline-none focus:ring-2 focus:ring-vibe-purple focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-200">
                                Add as Friend
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
