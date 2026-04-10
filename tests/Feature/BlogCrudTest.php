<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BlogCrudTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function admin_can_create_blog_post_with_valid_input(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->post(route('admin.blog.store'), [
            'title' => 'How to Optimize Product Images',
            'slug' => 'how-to-optimize-product-images',
            'content' => '<p>Useful content here.</p><script>alert(1)</script>',
            'status' => 'published',
            'excerpt' => 'A compact guide for ecommerce image optimization.',
            'featured_image' => UploadedFile::fake()->image('cover.jpg'),
        ]);

        $response->assertRedirect(route('admin.blog.index'));

        $post = BlogPost::query()->first();
        $this->assertNotNull($post);
        $this->assertSame('how-to-optimize-product-images', $post->slug);
        $this->assertStringNotContainsString('<script>', $post->content);
        $this->assertSame('published', $post->status);
    }

    #[Test]
    public function blog_index_shows_only_published_posts(): void
    {
        BlogPost::query()->create([
            'title' => 'Published Post',
            'slug' => 'published-post',
            'content' => '<p>Published</p>',
            'status' => 'published',
            'published_at' => now()->subMinute(),
        ]);

        BlogPost::query()->create([
            'title' => 'Draft Post',
            'slug' => 'draft-post',
            'content' => '<p>Draft</p>',
            'status' => 'draft',
        ]);

        $this->get(route('blog'))
            ->assertOk()
            ->assertSee('Published Post')
            ->assertDontSee('Draft Post');
    }

    #[Test]
    public function admin_can_upload_editor_image(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->post(route('admin.blog.editor-upload'), [
            'file' => UploadedFile::fake()->image('inline.png', 1200, 800),
        ]);

        $response->assertOk()->assertJsonStructure(['location']);
    }
}
