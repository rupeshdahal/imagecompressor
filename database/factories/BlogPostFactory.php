<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        $slug = str($title)->slug();

        return [
            'author_id'         => User::where('is_admin', true)->first()?->id ?? null,
            'title'             => $title,
            'slug'              => $slug,
            'meta_title'        => $title . ' | CompresslyPro',
            'meta_description'  => $this->faker->sentence(15),
            'excerpt'           => $this->faker->paragraph(),
            'featured_image_path' => null,
            'content'           => $this->faker->paragraphs(10, true),
            'status'            => 'published',
            'published_at'      => $this->faker->dateTimeBetween('-6 months'),
        ];
    }

    /**
     * Create a blog post with draft status.
     */
    public function draft(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status'      => 'draft',
                'published_at' => null,
            ];
        });
    }

    /**
     * Create a blog post with unpublished status.
     */
    public function unpublished(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status'      => 'draft',
                'published_at' => null,
            ];
        });
    }
}
