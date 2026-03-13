<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function page($slug)
    {
        $page = Page::active()->ofType('page')->where('slug', $slug)->firstOrFail();
        return view('dynamic.page', compact('page'));
    }

    public function tool($slug)
    {
        $page = Page::active()->ofType('tool')->where('slug', $slug)->firstOrFail();
        return view('dynamic.tool', compact('page'));
    }

    public function blogIndex()
    {
        $posts = Page::active()->ofType('blog')->orderBy('sort_order')->get();
        return view('dynamic.blog-index', compact('posts'));
    }

    public function blogShow($slug)
    {
        $post = Page::active()->ofType('blog')->where('slug', $slug)->firstOrFail();
        return view('dynamic.blog-show', compact('post'));
    }
}
