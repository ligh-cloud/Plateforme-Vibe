<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight tracking-tight">
            {{ __('Mes Amis') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-xl ring-1 ring-gray-200 dark:ring-gray-700 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">
                        {{ __('Liste des Utilisateurs') }}
                    </h3>

                    <!-- Users Table -->
                    @if ($users->isEmpty())
                        <p class="text-base text-gray-600 dark:text-gray-400">
                            {{ __('Aucun utilisateur trouvé.') }}
                        </p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-gray-700 dark:text-gray-300">
                                <thead class="bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                <tr>
                                    <th class="px-4 py-3 font-semibold rounded-tl-xl">Avatar</th>
                                    <th class="px-4 py-3 font-semibold">Pseudo</th>
                                    <th class="px-4 py-3 font-semibold">Email</th>
                                    <th class="px-4 py-3 font-semibold">Bio</th>
                                    <th class="px-4 py-3 font-semibold rounded-tr-xl">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                        <td class="px-4 py-4">
                                            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="{{ $user->name }}'s avatar" class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600">
                                        </td>
                                        <td class="px-4 py-4">{{ $user->name }}</td>
                                        <td class="px-4 py-4">{{ $user->email }}</td>
                                        <td class="px-4 py-4">
                                            {{ $user->bio ?? 'Aucune bio disponible' }}
                                        </td>
                                        <td class="px-4 py-4">
                                            <a href="{{ route('add_friend', ['user' => $user->id]) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-vibe-purple to-vibe-teal text-red rounded-lg font-medium hover:from-vibe-purple/80 hover:to-vibe-teal/80 focus:outline-none focus:ring-2 focus:ring-vibe-purple focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-200">--}}
                                                {{ __('Voir') }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-4">
                                            <a href="{{route('add_friend' , ['user' => $user->id])}}">Add friends</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Inline Tailwind Config for Custom Colors -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'vibe-purple': '#8B5CF6',
                        'vibe-teal': '#0F766E',
                    }
                }
            }
        }
    </script>
</x-app-layout>
