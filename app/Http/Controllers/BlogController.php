<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('user')
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get();

        return view('blog.index', compact('posts'));
    }

    public function show(BlogPost $post)
    {
       $post = $post->load('user');

        return view('blog.show', compact('post'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog-images', 'public');
        }

        $post = BlogPost::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image_path' => $imagePath,
            'slug' => Str::slug($validated['title']),
            'published_at' => now(),
            'user_id' => auth()->id() ?? 1
        ]);

        return redirect()->route('blog.index')->with('success', 'Successfully created!');
    }

    public function edit(BlogPost $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $blog->image_path;
        if ($request->hasFile('image')) {
            if ($blog->image_path) {
                Storage::disk('public')->delete($blog->image_path);
            }
            $imagePath = $request->file('image')->store('blog-images', 'public');
        } elseif ($request->has('remove_image') && $request->remove_image) {
            if ($blog->image_path) {
                Storage::disk('public')->delete($blog->image_path);
            }
            $imagePath = null;
        }

        $blog->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image_path' => $imagePath,
            'slug' => Str::slug($validated['title'])
        ]);

        return redirect()->route('blog.show', $blog)->with('success', 'Successfully updated!');
    }

    public function destroy(BlogPost $blog)
    {
        if ($blog->image_path) {
            Storage::disk('public')->delete($blog->image_path);
        }

        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Successfully deleted!');
    }
}
