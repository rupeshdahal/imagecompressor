<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminBlogPostController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::query()
            ->orderByDesc('updated_at')
            ->paginate(12);

        return view('admin.blog.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.blog.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        BlogPost::create($data);

        return redirect()
            ->route('admin.blog.index')
            ->with('status', 'Blog post created successfully.');
    }

    public function show(BlogPost $blogPost): View
    {
        return view('admin.blog.show', compact('blogPost'));
    }

    public function edit(BlogPost $blogPost): View
    {
        return view('admin.blog.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost): RedirectResponse
    {
        $data = $this->validatedData($request, $blogPost);

        $blogPost->update($data);

        return redirect()
            ->route('admin.blog.index')
            ->with('status', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogPost): RedirectResponse
    {
        $blogPost->delete();

        return redirect()
            ->route('admin.blog.index')
            ->with('status', 'Blog post deleted successfully.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, ?BlogPost $blogPost = null): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', 'unique:blog_posts,slug' . ($blogPost ? ',' . $blogPost->id : '')],
            'category' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'string', 'max:255'],
            'featured_image_file' => ['nullable', 'image', 'max:5120'],
            'published_at' => ['nullable', 'date'],
        ]);

        $validated['slug'] = filled($validated['slug'] ?? null)
            ? Str::slug((string) $validated['slug'])
            : Str::slug((string) $validated['title']);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');

        if ($validated['is_published'] && blank($validated['published_at'] ?? null)) {
            $validated['published_at'] = now();
        }

        if (! $validated['is_published']) {
            $validated['published_at'] = null;
        }

        if ($request->hasFile('featured_image_file')) {
            $path = $request->file('featured_image_file')->store('blog', 'public');
            $validated['featured_image'] = Storage::url($path);

            if ($blogPost && filled($blogPost->featured_image)) {
                $this->deleteLocalImage((string) $blogPost->featured_image);
            }
        }

        if ($request->boolean('remove_featured_image')) {
            if ($blogPost && filled($blogPost->featured_image)) {
                $this->deleteLocalImage((string) $blogPost->featured_image);
            }

            $validated['featured_image'] = null;
        }

        return $validated;
    }

    private function deleteLocalImage(string $imagePath): void
    {
        $normalizedPath = parse_url($imagePath, PHP_URL_PATH) ?: $imagePath;

        if (! Str::startsWith($normalizedPath, '/storage/')) {
            return;
        }

        $storagePath = Str::after($normalizedPath, '/storage/');

        if (filled($storagePath)) {
            Storage::disk('public')->delete($storagePath);
        }
    }
}