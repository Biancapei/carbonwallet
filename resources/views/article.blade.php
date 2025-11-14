@extends('layouts.app')

@php
    use Illuminate\Support\Str;
    $metaTitle = $blog->meta_title ?: $blog->title;
    $metaDescription = $blog->meta_description ?: Str::limit(strip_tags($blog->content), 160);
    $metaImage = $blog->image_url ?: asset('images/carbon_meta.png');
    $articleUrl = route('article.show', $blog);
@endphp

@section('title', $metaTitle)
@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)
@section('meta_image', $metaImage)

@push('meta_tags')
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ $articleUrl }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    @if($blog->image_url)
        @php
            $imagePath = parse_url($blog->image_url, PHP_URL_PATH);
            $publicPath = public_path(ltrim($imagePath, '/'));
            $cacheVersion = file_exists($publicPath) ? filemtime($publicPath) : time();
        @endphp
        <meta property="og:image" content="{{ $blog->image_url }}?v={{ $cacheVersion }}">
        <meta property="og:image:secure_url" content="{{ $blog->image_url }}?v={{ $cacheVersion }}">
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="{{ $blog->image_alt ?? $blog->title }}">
    @endif

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $articleUrl }}">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    @if($blog->image_url)
        <meta name="twitter:image" content="{{ $blog->image_url }}?v={{ $cacheVersion }}">
    @endif

    <!-- Article Meta -->
    <meta property="article:published_time" content="{{ $blog->created_at->toIso8601String() }}">
    <meta property="article:modified_time" content="{{ $blog->updated_at->toIso8601String() }}">
    <meta property="article:author" content="{{ optional($blog->user)->name ?? 'Admin' }}">
    @if($blog->category)
        <meta property="article:section" content="{{ ucfirst(str_replace('-', ' ', $blog->category)) }}">
    @endif
    @if($blog->meta_keywords)
        <meta name="keywords" content="{{ $blog->meta_keywords }}">
    @endif
@endpush

@section('content')
<div class="article-bg">
    <div class="green-ball">
        <img src="{{ asset('images/home/greenball.png') }}" style="max-width: 100%;">
    </div>
    <div class="container">
        <div class="article-container">
            <a href="{{ route('blogs') }}" class="back-button">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Blog
            </a>

            <article>
                <header class="article-header">
                    <div class="article-meta">
                        <span>{{ $blog->created_at->format('M d, Y') }}</span>
                        <span>•</span>
                        <span>{{ optional($blog->user)->name ?? 'Admin' }}</span>
                    </div>

                    <h1 class="article-title">{{ $blog->title }}</h1>

                    @if($blog->description)
                        <p class="article-description">{{ $blog->description }}</p>
                    @endif
                </header>

                @if($blog->image_url)
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->image_alt ?? $blog->title }}" class="article-image">
                @endif

                <div class="article-content">
                    {!! $blog->content !!}
                </div>
            </article>

            @if($relatedBlogs->count() > 0)
                <section class="related-posts">
                    <h3>Related Articles</h3>
                    <div class="related-grid">
                        @foreach($relatedBlogs as $relatedBlog)
                            <div class="related-card">
                                @if($relatedBlog->image_url)
                                    <img src="{{ $relatedBlog->image_url }}" alt="{{ $relatedBlog->image_alt ?? $relatedBlog->title }}">
                                @endif
                                <div class="related-card-content">
                                    <h4>{{ $relatedBlog->title }}</h4>
                                    @if($relatedBlog->description)
                                        <p>{{ Str::limit($relatedBlog->description, 100) }}</p>
                                    @endif
                                    <a href="{{ route('article.show', $relatedBlog) }}" class="read-more">
                                        Read More →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>
</div>
@endsection
