<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center py-6">
                <a href="{{ route('blog.index') }}" class="flex items-center text-gray-600 hover:text-gray-900 mr-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Post content</h1>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <article class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Post Image -->
            @if($post->image_path)
                <div class="w-full h-64 md:h-96 bg-gray-200">
                    <img src="{{ asset('storage/' . $post->image_path) }}"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Post Header -->
            <div class="p-8">
                <div class="mb-6">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        {{ $post->title }}
                    </h1>

                    <!-- Post Meta -->
                    <div class="flex items-center space-x-4 text-sm text-gray-500 mb-6">
                        <div class="flex items-center">
                            <span class="mr-2">👤</span>
                            <span>{{ $post->user->name ?? 'Unknown author' }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2">📅</span>
                            <span>{{ $post->published_at->format('d.m.Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="prose prose-lg max-w-none">
                    <div class="text-gray-700 leading-relaxed whitespace-pre-wrap">
                        {{ $post->content }}
                    </div>
                </div>

                <!-- Admin Actions -->
                @auth
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.blog.edit', $post->id) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                Редагувати
                            </a>
                            <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure, you want delete this post')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </article>

        <!-- Back to Blog Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('blog.index') }}"
               class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif
</body>
</html>
