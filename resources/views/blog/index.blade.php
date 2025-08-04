<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Projects</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Blog</h1>
                    <p class="text-gray-600 mt-2">Training projects</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('listing.index') }}" class="text-blue-600 hover:text-blue-700">Listing</a>
                    @auth
                        <a href="{{ route('admin.blog.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Create post</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Blog Posts -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($posts->count() === 0)
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">📝</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No posts</h3>
                <p class="text-gray-600">New post approaching</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden">
                        <!-- Post Image -->
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                            @if($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}"
                                     alt="{{ $post->title }}"
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                                    <div class="text-4xl text-gray-400">📄</div>
                                </div>
                            @endif
                        </div>

                        <!-- Post Content -->
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-3">
                                {{ $post->title }}
                            </h2>
                            <p class="text-gray-600 text-sm mb-4">
                                {{ Str::limit($post->content, 150) }}
                            </p>

                            <!-- Post Meta -->
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center space-x-2">
                                    <span>👤 {{ $post->user->name ?? 'Unknown author' }}</span>
                                </div>
                                <span>{{ $post->published_at->format('d.m.Y') }}</span>
                            </div>

                            <!-- Read More Button -->
                            <div class="mt-4">
                                <a href="{{ route('blog.show', $post->slug) }}"
                                   class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                                    Read more
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @if(session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif
</body>
</html>
