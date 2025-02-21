<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Utilisateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">{{ __('Bienvenue, ') . Auth::user()->name }}</h3>
                    <p class="mt-2 text-sm">{{ __('Gérez votre profil et explorez les utilisateurs.') }}</p>
                </div>
            </div>

            <!-- Formulaire de modification du profil -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mt-6 p-6">
                <h3 class="font-semibold text-lg">{{ __('Modifier le profil') }}</h3>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mt-4">
                        <label class="block text-sm">Pseudo</label>
                        <input type="text" name="name" class="w-full px-3 py-2 border rounded-lg" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm">Email</label>
                        <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg" value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm">Bio</label>
                        <textarea name="bio" class="w-full px-3 py-2 border rounded-lg">{{ Auth::user()->bio }}</textarea>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm">Photo de profil</label>
                        <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" class="w-24 h-24 rounded-full">

                        <input type="file" name="avatar" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Enregistrer</button>
                    </div>
                </form>
            </div>

            <!-- Recherche d'utilisateurs -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mt-6 p-6">
                <h3 class="font-semibold text-lg">{{ __('Rechercher un utilisateur') }}</h3>
                <form action="{{ route('user.search') }}" method="GET">
                    <div class="mt-4">
                        <input type="text" name="search" class="w-full px-3 py-2 border rounded-lg" placeholder="Rechercher par pseudo ou email">
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Rechercher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
