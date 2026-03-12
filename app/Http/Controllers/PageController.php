<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    /**
     * Tool landing page.
     */
    public function tool(string $slug)
    {
        $page = Page::active()->ofType('tool')->where('slug', $slug)->firstOrFail();

        return view('dynamic.tool', compact('page'));
    }

    /**
     * Blog index.
     */
    public function blogIndex()
    {
        $featured = Page::blogs()->where('is_featured', true)->first();
        $posts    = Page::blogs()->where('is_featured', false)->get();

        return view('dynamic.blog-index', compact('featured', 'posts'));
    }

    /**
     * Single blog post.
     */
    public function blogShow(string $slug)
    {
        $page = Page::active()->ofType('blog')->where('slug', $slug)->firstOrFail();

        return view('dynamic.blog-show', compact('page'));
    }

    /**
     * Static page (about, contact).
     */
    public function page(string $slug)
    {
        $page = Page::active()->ofType('page')->where('slug', $slug)->firstOrFail();

        return view('dynamic.page', compact('page'));
    }
}
