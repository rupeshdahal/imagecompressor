<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BlogController extends Controller
{
    // ── Public ────────────────────────────────────────────────

    public function index(): View
    {
        $posts    = BlogPost::published()->latest()->paginate(12);
        $featured = BlogPost::published()->featured()->latest()->first();

        return view('blog.index', compact('posts', 'featured'));
    }

    public function show(BlogPost $post): View
    {
        if (! $post->is_published) {
            abort(404);
        }

        $related = $post->related(2);

        return view('blog.show', compact('post', 'related'));
    }

    // ── Admin ─────────────────────────────────────────────────

    public function adminIndex(): View
    {
        $posts = BlogPost::latest()->paginate(20);
        return view('admin.blog.index', compact('posts'));
    }

    public function adminCreate(): View
    {
        return view('admin.blog.create');
    }

    public function adminStore(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'slug'              => 'required|string|max:255|unique:blog_posts,slug',
            'excerpt'           => 'required|string|max:500',
            'content'           => 'required|string',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:320',
            'meta_keywords'     => 'nullable|string',
            'og_title'          => 'nullable|string|max:255',
            'og_description'    => 'nullable|string|max:320',
            'category'          => 'required|string|max:100',
            'tags'              => 'nullable|string',
            'read_time'         => 'required|integer|min:1|max:60',
            'word_count'        => 'nullable|integer',
            'schema_keywords'   => 'nullable|string',
            'date_published'    => 'required|date',
            'date_modified'     => 'required|date',
            'is_published'      => 'boolean',
            'is_featured'       => 'boolean',
        ]);

        // Parse comma-sep tags to array
        if (! empty($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        }

        $data['is_published'] = $request->boolean('is_published');
        $data['is_featured']  = $request->boolean('is_featured');
        $data['word_count']   = $data['word_count'] ?? 0;

        BlogPost::create($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function adminEdit(BlogPost $post): View
    {
        return view('admin.blog.edit', compact('post'));
    }

    public function adminUpdate(Request $request, BlogPost $post): RedirectResponse
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'slug'              => 'required|string|max:255|unique:blog_posts,slug,' . $post->id,
            'excerpt'           => 'required|string|max:500',
            'content'           => 'required|string',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:320',
            'meta_keywords'     => 'nullable|string',
            'og_title'          => 'nullable|string|max:255',
            'og_description'    => 'nullable|string|max:320',
            'category'          => 'required|string|max:100',
            'tags'              => 'nullable|string',
            'read_time'         => 'required|integer|min:1|max:60',
            'word_count'        => 'nullable|integer',
            'schema_keywords'   => 'nullable|string',
            'date_published'    => 'required|date',
            'date_modified'     => 'required|date',
            'is_published'      => 'boolean',
            'is_featured'       => 'boolean',
        ]);

        if (! empty($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        }

        $data['is_published'] = $request->boolean('is_published');
        $data['is_featured']  = $request->boolean('is_featured');
        $data['word_count']   = $data['word_count'] ?? 0;

        $post->update($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function adminDestroy(BlogPost $post): RedirectResponse
    {
        $post->delete();
        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post deleted.');
    }
}
