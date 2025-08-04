<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center py-6">

                <a href="{{ route('blog.show', $blog->slug) }}" class="flex items-center text-gray-600 hover:text-gray-900 mr-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Edit post</h1>
            </div>
        </div>
    </header>

    <!-- Form -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-xl shadow-sm p-8">
            <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Title *
                    </label>
                    <input
                        id="title"
                        name="title"
                        type="text"
                        value="{{ old('title', $blog->title) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                        placeholder="Post title"
                        required
                    />
                    @error('title')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Content -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        Content *
                    </label>

                    <!-- Toolbar -->
                    <div class="mb-2 flex flex-wrap gap-2">
                        <button type="button" onclick="addLink()" class="px-3 py-1 bg-blue-500 text-white rounded text-sm hover:bg-blue-600">
                            🔗 Add Link
                        </button>
                        <button type="button" onclick="addBold()" class="px-3 py-1 bg-gray-500 text-white rounded text-sm hover:bg-gray-600">
                            <strong>B</strong> Bold
                        </button>
                        <button type="button" onclick="addItalic()" class="px-3 py-1 bg-gray-500 text-white rounded text-sm hover:bg-gray-600">
                            <em>I</em> Italic
                        </button>
                        <button type="button" onclick="addHeading()" class="px-3 py-1 bg-green-500 text-white rounded text-sm hover:bg-green-600">
                            H1 Heading
                        </button>
                        <button type="button" onclick="addList()" class="px-3 py-1 bg-purple-500 text-white rounded text-sm hover:bg-purple-600">
                            📝 List
                        </button>
                    </div>

                    <div class="mb-2 text-xs text-gray-600">
                        💡 <strong>Advice:</strong> Select the text and click the button to format, or enter the text in the dialog box.
                        .
                    </div>

                    <textarea
                        id="content"
                        name="content"
                        rows="10"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-500 @enderror"
                        placeholder="Describe"
                        required
                    >{{ old('content', $blog->content) }}</textarea>
                    @error('content')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Image (optional)
                    </label>

                    <!-- Current Image -->
                    @if($blog->image_path)
                        <div class="mb-4">
                            <div class="relative inline-block">
                                <img src="{{ asset('storage/' . $blog->image_path) }}"
                                     alt="Current image"
                                     class="w-32 h-32 object-cover rounded-lg">
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Current image</p>
                        </div>
                    @endif

                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-500 @enderror"
                    />
                    @error('image')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('blog.show', $blog->slug) }}"
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Renew
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    <script>
        function addLink() {
            const textarea = document.getElementById('content');
            const selectedText = getSelectedText(textarea);

            if (selectedText) {
                const url = prompt('Enter URL:');
                if (url) {
                    const link = `<a href="${url}" target="_blank">${selectedText}</a>`;
                    replaceSelection(textarea, link);
                }
            } else {
                const url = prompt('Enter URL:');
                const text = prompt('Enter link text:');

                if (url && text) {
                    const link = `<a href="${url}" target="_blank">${text}</a>`;
                    insertAtCursor(textarea, link);
                }
            }
        }

        function addBold() {
            const textarea = document.getElementById('content');
            const selectedText = getSelectedText(textarea);

            if (selectedText) {
                const boldText = `<strong>${selectedText}</strong>`;
                replaceSelection(textarea, boldText);
            } else {
                const text = prompt('Enter text to make bold:');
                if (text) {
                    const boldText = `<strong>${text}</strong>`;
                    insertAtCursor(textarea, boldText);
                }
            }
        }

        function addItalic() {
            const textarea = document.getElementById('content');
            const selectedText = getSelectedText(textarea);

            if (selectedText) {
                const italicText = `<em>${selectedText}</em>`;
                replaceSelection(textarea, italicText);
            } else {
                const text = prompt('Enter text to make italic:');
                if (text) {
                    const italicText = `<em>${text}</em>`;
                    insertAtCursor(textarea, italicText);
                }
            }
        }

        function getSelectedText(textarea) {
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            return textarea.value.substring(start, end);
        }

        function replaceSelection(textarea, newText) {
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;

            const before = textarea.value.substring(0, start);
            const after = textarea.value.substring(end);

            textarea.value = before + newText + after;
            textarea.focus();
            textarea.setSelectionRange(start + newText.length, start + newText.length);
        }

        function insertAtCursor(textarea, text) {
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;

            const before = textarea.value.substring(0, start);
            const after = textarea.value.substring(end);

            textarea.value = before + text + after;
            textarea.focus();
            textarea.setSelectionRange(start + text.length, start + text.length);
        }

        function addHeading() {
            const textarea = document.getElementById('content');
            const selectedText = getSelectedText(textarea);

            if (selectedText) {
                const heading = `<h1>${selectedText}</h1>`;
                replaceSelection(textarea, heading);
            } else {
                const text = prompt('Enter heading text:');
                if (text) {
                    const heading = `<h1>${text}</h1>`;
                    insertAtCursor(textarea, heading);
                }
            }
        }

        function addList() {
            const textarea = document.getElementById('content');
            const items = prompt('Enter list items separated by commas:');

            if (items) {
                const itemArray = items.split(',').map(item => item.trim());
                const listItems = itemArray.map(item => `  <li>${item}</li>`).join('\n');
                const list = `<ul>\n${listItems}\n</ul>`;
                insertAtCursor(textarea, list);
            }
        }
    </script>
</body>
</html>
