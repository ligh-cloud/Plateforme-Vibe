<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight tracking-tight">
            {{ __('Tableau de Bord') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Welcome Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl ring-1 ring-gray-200 dark:ring-gray-700">
                <div class="p-6 sm:p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ __('Bienvenue, ') . Auth::user()->name }}
                    </h3>
                    <p class="mt-2 text-base text-gray-600 dark:text-gray-400">
                        {{ __('Gérez votre profil et connectez-vous avec d\'autres utilisateurs.') }}
                    </p>
                </div>
            </div>

            <!-- Profile Edit Form -->
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-xl ring-1 ring-gray-200 dark:ring-gray-700 p-6 sm:p-8">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">
                    {{ __('Modifier Votre Profil') }}
                </h3>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pseudo</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" required
                               class="mt-1 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-vibe-purple focus:border-transparent transition duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" required
                               class="mt-1 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-vibe-purple focus:border-transparent transition duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bio</label>
                        <textarea name="bio" rows="4" class="mt-1 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-vibe-purple focus:border-transparent transition duration-200">{{ Auth::user()->bio }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Photo de Profil</label>
                        <div class="mt-2 flex items-center space-x-4">
                            <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" class="w-20 h-20 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600">
                            <input type="file" name="avatar" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-vibe-purple focus:border-transparent transition duration-200">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="bg-gradient-to-r from-vibe-purple to-vibe-teal text-white px-6 py-3 rounded-lg font-medium hover:from-vibe-purple/80 hover:to-vibe-teal/80 focus:outline-none focus:ring-2 focus:ring-vibe-purple focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-200">
                            {{ __('Enregistrer') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- User Search Section -->
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-xl ring-1 ring-gray-200 dark:ring-gray-700 p-6 sm:p-8">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">
                    {{ __('Rechercher des Utilisateurs') }}
                </h3>
                <form action="{{ route('user.search') }}" method="GET" class="space-y-6">
                    <div>
                        <input type="text" name="search" placeholder="Rechercher par pseudo ou email" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-vibe-purple focus:border-transparent transition duration-200">
                    </div>
                    <div>
                        <button type="submit" class="bg-gradient-to-r from-vibe-purple to-vibe-teal text-white px-6 py-3 rounded-lg font-medium hover:from-vibe-purple/80 hover:to-vibe-teal/80 focus:outline-none focus:ring-2 focus:ring-vibe-purple focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-200">
                            {{ __('Rechercher') }}
                        </button>
                    </div>
                </form>
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
