<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Demandes d\'ami en attente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($pendingRequests->count() > 0)
                        <ul class="list-group">
                            @foreach ($pendingRequests as $request)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $request->sender->name }}</strong> veut être votre ami
                                    </div>
                                    <div class="btn-group">
                                        <form action="{{ route('friends.accept', $request->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                    class="bg-gradient-to-r from-vibe-purple to-vibe-teal text-gray-700 rounded-lg px-4 py-2 font-medium hover:from-vibe-purple/80 hover:to-vibe-teal/80 focus:outline-none focus:ring-2 focus:ring-vibe-purple focus:ring-offset-2 transition duration-200">
                                                {{ __('Accepter') }}
                                            </button>
                                        </form>
                                        <form action="{{ route('friends.reject', $request->id) }}" method="POST" class="ml-2">
                                            @csrf
                                            <button type="submit"
                                                    class="bg-gray-300 text-red-500-800 rounded-lg px-4 py-2 font-medium hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200">
                                                {{ __('Refuser') }}
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Vous n'avez aucune demande d'ami en attente.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
