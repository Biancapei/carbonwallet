<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'blogs']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $homepageBlogs = Blog::published()->with('user')->latest()->take(3)->get();

        return view('home', [
            'homepageBlogs' => $homepageBlogs,
        ]);
    }

    public function show(Blog $blog)
    {
        if (!$blog->is_published) {
            abort(404);
        }

        $relatedBlogs = Blog::published()
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(3)
            ->get();

        return view('article', [
            'blog' => $blog,
            'relatedBlogs' => $relatedBlogs,
        ]);
    }

    public function blogs()
    {
        $perPage = 4;

        $blogs = Blog::published()
            ->with('user')
            ->latest()
            ->paginate($perPage);

        $carbonAccountingBlogs = Blog::published()
            ->with('user')
            ->where('category', 'carbon-accounting')
            ->latest()
            ->paginate($perPage, ['*'], 'carbon-accounting-page');

        $hospitalityBlogs = Blog::published()
            ->with('user')
            ->where('category', 'hospitality')
            ->latest()
            ->paginate($perPage, ['*'], 'hospitality-page');

        $netZeroBlogs = Blog::published()
            ->with('user')
            ->where('category', 'net-zero')
            ->latest()
            ->paginate($perPage, ['*'], 'net-zero-page');

        $regulationsBlogs = Blog::published()
            ->with('user')
            ->where('category', 'regulations')
            ->latest()
            ->paginate($perPage, ['*'], 'regulations-page');

        return view('blogs', compact(
            'blogs',
            'carbonAccountingBlogs',
            'hospitalityBlogs',
            'netZeroBlogs',
            'regulationsBlogs'
        ));
    }
}
