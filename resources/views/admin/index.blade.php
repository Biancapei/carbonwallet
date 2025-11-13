@extends('admin.layout')

@section('content')
<div>
    <div class="admin-index-header">
        <h1>Blog Management</h1>
        <a href="{{ route('admin.create') }}" class="create-new-post-btn" onmouseover="this.style.background='#16d3ca'" onmouseout="this.style.background='#000'">
            Create New Post
        </a>
    </div>

    @if($blogs->count() > 0)
        <div class="admin-table-container">
            <div class="admin-table-wrapper">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogs as $blog)
                                    <tr>
                                        <td>
                                            @if($blog->image)
                                                <img class="blog-image" src="{{ $blog->image_url }}" alt="{{ $blog->title }}">
                                            @else
                                                <div class="admin-placeholder-image">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="admin-blog-title">
                                                {{ $blog->title }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($blog->is_published)
                                                <span class="status-published">Published</span>
                                            @else
                                                <span class="status-draft">Draft</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="admin-actions">
                                                <a href="{{ route('admin.edit', $blog->id) }}">
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('admin.destroy', $blog->id) }}" onsubmit="return confirm('Are you sure you want to delete this blog post?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

            @if($blogs->hasPages())
                <div class="admin-pagination-wrapper">
                    {{ $blogs->links('vendor.pagination.simple') }}
                </div>
            @endif
        </div>
    @else
        <div class="admin-empty-state">
            <h3>No blog posts</h3>
            <p>Get started by creating a new blog post.</p>
            <a href="{{ route('admin.create') }}" class="create-new-post-btn">
                Create your first blog post
            </a>
        </div>
    @endif
</div>
@endsection
