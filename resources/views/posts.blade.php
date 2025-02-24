    <x-app-layout>
        <div class="bg-gray-100 flex flex-col items-center justify-center min-h-screen p-4">
            <!-- Post Form -->
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-2xl font-bold mb-4">Create a Post</h2>

                @if(session('message'))
                    <p class="text-green-500">{{ session('message') }}</p>
                @endif

                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label for="content" class="block text-gray-700 font-bold">Content:</label>
                        <textarea id="content" name="content" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" rows="4" required></textarea>
                        @error('content')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-gray-700 font-bold">Upload Image:</label>
                        <input type="file" id="image" name="image" class="w-full p-2 border border-gray-300 rounded-md" accept="image/*">
                        @error('image')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                        Submit Post
                    </button>
                </form>
            </div>

            <!-- Posts List -->
            <div class="mt-6 w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">All Posts</h2>
                @foreach($posts as $post)
                    <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-40 object-cover rounded-md mb-2">
                        @endif
                        <p class="text-gray-700">{{ $post->content }}</p>

                        <!-- Check if the user has liked the post -->
                        @php
                            $isLiked = $post->likes->contains('user_id', $user_id);
                        @endphp

                            <!-- Post Actions -->
                        <div class="mt-4 flex space-x-4">
                            <!-- Like Button -->
                            <form action="{{ route('posts.like', $post->id) }}" method="POST" class="inline">
                                @csrf

                                <button type="submit" class="flex items-center space-x-1 transition duration-300
                        {{ $isLiked ? 'text-blue-500' : 'text-gray-600 hover:text-blue-500' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                    </svg>
                                    <span>{{ $isLiked ? 'Liked' : 'Like' }}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-app-layout>
