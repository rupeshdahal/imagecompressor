<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::orderByDesc('published_at')->orderByDesc('created_at')->get();

        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.form', [
            'post' => new BlogPost([
                'is_published' => true,
                'featured' => false,
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatePost($request);
        BlogPost::create($data);

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blogPost)
    {
        return view('admin.blog.form', [
            'post' => $blogPost,
        ]);
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $data = $this->validatePost($request, $blogPost->id);
        $blogPost->update($data);

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    private function validatePost(Request $request, ?int $postId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9\-]+$/', 'unique:blog_posts,slug,' . $postId],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string'],
            'schema_json' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'read_time_minutes' => ['nullable', 'integer', 'min:1', 'max:120'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
            'featured' => ['nullable', 'boolean'],
        ]) + [
            'is_published' => $request->boolean('is_published'),
            'featured' => $request->boolean('featured'),
        ];
    }
}
