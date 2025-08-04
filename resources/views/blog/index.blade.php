<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Projects</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .prose a {
            color: #2563eb;
            text-decoration: underline;
            transition: color 0.2s ease;
        }
        .prose a:hover {
            color: #1d4ed8;
            text-decoration: none;
        }
        .prose a[target="_blank"]::after {
            content: " ↗";
            font-size: 0.75em;
            opacity: 0.7;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Blog</h1>
                    <p class="text-gray-600 mt-2">Training projects - Click on any post to read more</p>
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
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden group">
                        <a href="{{ route('blog.show', $post->slug) }}" class="block">
                            <!-- Post Image -->
                            <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                                @if($post->image_path)
                                    <img src="{{ asset('storage/' . $post->image_path) }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                                        <div class="text-4xl text-gray-400">📄</div>
                                    </div>
                                @endif
                            </div>

                            <!-- Post Content -->
                            <div class="p-6">
                                <h2 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                                    {{ $post->title }}
                                </h2>
                                <div class="text-gray-600 text-sm mb-4 prose prose-sm max-w-none">
                                    @php
                                        $content = $post->content;
                                        $plainText = strip_tags($content);
                                        $limitedText = Str::limit($plainText, 150);
                                        $hasMore = strlen($plainText) > 150;
                                    @endphp
                                    {!! $limitedText !!}
                                    @if($hasMore)
                                        <span class="text-blue-600">...</span>
                                    @endif
                                </div>

                                <!-- Post Meta -->
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <span>👤 {{ $post->user->name ?? 'Unknown author' }}</span>
                                    </div>
                                    <span>{{ $post->published_at->format('d.m.Y') }}</span>
                                </div>

                                <!-- Read More Indicator -->
                                <div class="mt-4">
                                    <div class="inline-flex items-center text-blue-600 group-hover:text-blue-700 font-medium">
                                        Read more
                                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
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

    <script>
        // Обробка кліків на посилання в превью
        document.addEventListener('DOMContentLoaded', function() {
            const postCards = document.querySelectorAll('.bg-white.rounded-xl');
            
            postCards.forEach(card => {
                const links = card.querySelectorAll('a[href]');
                
                links.forEach(link => {
                    link.addEventListener('click', function(e) {
                        // Якщо це зовнішнє посилання, дозволяємо клік
                        if (this.getAttribute('target') === '_blank' || 
                            this.href.includes('http') || 
                            this.href.includes('listing')) {
                            e.stopPropagation();
                            return true;
                        }
                        
                        // Якщо це внутрішнє посилання на блог, дозволяємо клік
                        if (this.href.includes('/blog/')) {
                            e.stopPropagation();
                            return true;
                        }
                        
                        // Для всіх інших посилань також дозволяємо клік
                        e.stopPropagation();
                    });
                });
            });
        });
    </script>
</body>
</html>
