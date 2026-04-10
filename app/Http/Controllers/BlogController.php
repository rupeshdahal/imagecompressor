<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;
use App\Models\BlogPost;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::query()
            ->published()
            ->latest('published_at')
            ->latest('id')
            ->paginate(9);

        return view('blog.index', compact('posts'));
    }

    public function show(string $slug): View
    {
        $post = BlogPost::query()
            ->published()
            ->where('slug', $slug)
            ->first();

        if ($post) {
            return view('blog.show', compact('post'));
        }

        // Backward compatibility for existing static blog pages.
        if (view()->exists('blog.' . $slug)) {
            return view('blog.' . $slug);
        }

        abort(404);
    }

    public function adminIndex(Request $request): View
    {
        $query = BlogPost::query()->with('author')->latest('updated_at');

        $search = trim((string) $request->query('search', ''));
        $status = trim((string) $request->query('status', ''));

        if ($search !== '') {
            $query->where(function ($inner) use ($search): void {
                $inner->where('title', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%');
            });
        }

        if (in_array($status, ['draft', 'published'], true)) {
            $query->where('status', $status);
        }

        $posts = $query->paginate(15)->withQueryString();

        return view('admin.blog.index', compact('posts', 'search', 'status'));
    }

    public function create(): View
    {
        return view('admin.blog.create');
    }

    public function store(StoreBlogPostRequest $request): RedirectResponse
    {
        $data = $this->mapValidatedData($request, null);
        $data['author_id'] = Auth::id();

        BlogPost::create($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $post): View
    {
        return view('admin.blog.edit', compact('post'));
    }

    public function update(UpdateBlogPostRequest $request, BlogPost $post): RedirectResponse
    {
        $post->update($this->mapValidatedData($request, $post));

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $post): RedirectResponse
    {
        if ($post->featured_image_path && Storage::disk('public')->exists($post->featured_image_path)) {
            Storage::disk('public')->delete($post->featured_image_path);
        }

        $post->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post deleted.');
    }

    public function uploadEditorImage(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $path = $request->file('file')->store('blog/editor', 'public');

        return response()->json([
            'location' => Storage::url($path),
        ]);
    }

    private function mapValidatedData(Request $request, ?BlogPost $post): array
    {
        $validated = $request->validated();

        $title = trim(strip_tags((string) ($validated['title'] ?? '')));
        $slugInput = trim((string) ($validated['slug'] ?? ''));
        $slug = $slugInput !== '' ? Str::slug($slugInput) : Str::slug($title);

        $excerpt = trim(strip_tags((string) ($validated['excerpt'] ?? '')));
        $metaTitle = trim(strip_tags((string) ($validated['meta_title'] ?? '')));
        $metaDescription = trim(strip_tags((string) ($validated['meta_description'] ?? '')));

        $content = $this->sanitizeHtml((string) ($validated['content'] ?? ''));
        $status = (string) ($validated['status'] ?? 'draft');

        $publishedAt = $validated['published_at'] ?? null;
        if ($status === 'published' && empty($publishedAt)) {
            $publishedAt = now();
        }
        if ($status === 'draft') {
            $publishedAt = null;
        }

        $payload = [
            'title' => Str::limit($title, 160, ''),
            'slug' => Str::limit($slug, 180, ''),
            'meta_title' => $metaTitle !== '' ? Str::limit($metaTitle, 160, '') : null,
            'meta_description' => $metaDescription !== '' ? Str::limit($metaDescription, 320, '') : null,
            'excerpt' => $excerpt !== '' ? Str::limit($excerpt, 2000, '') : null,
            'content' => $content,
            'status' => $status,
            'published_at' => $publishedAt,
        ];

        if ((bool) $request->boolean('remove_featured_image') && $post?->featured_image_path) {
            Storage::disk('public')->delete($post->featured_image_path);
            $payload['featured_image_path'] = null;
        }

        if ($request->hasFile('featured_image')) {
            if ($post?->featured_image_path && Storage::disk('public')->exists($post->featured_image_path)) {
                Storage::disk('public')->delete($post->featured_image_path);
            }

            $payload['featured_image_path'] = $request->file('featured_image')->store('blog/featured', 'public');
        }

        return $payload;
    }

    private function sanitizeHtml(string $html): string
    {
        $clean = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html) ?? '';
        $clean = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $clean) ?? '';
        $clean = preg_replace('/\s(on\w+)=("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $clean) ?? '';

        $allowedTags = '<p><br><h2><h3><h4><blockquote><ul><ol><li><a><strong><em><b><i><u><img><table><thead><tbody><tr><th><td><hr><code><pre>';

        return trim(strip_tags($clean, $allowedTags));
    }
}
