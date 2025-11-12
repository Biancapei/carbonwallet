@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('title', $blog->title)
@section('meta_title', $blog->meta_title ?: $blog->title)
@section('meta_description', $blog->meta_description ?: Str::limit(strip_tags($blog->content), 150))
@if($blog->image_url)
    @section('meta_image', $blog->image_url)
@endif

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
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="article-image">
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
                                    <img src="{{ $relatedBlog->image_url }}" alt="{{ $relatedBlog->title }}">
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
