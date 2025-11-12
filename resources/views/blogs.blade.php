@extends('layouts.app')

@section('title', 'Blogs')
@section('meta_title', 'Carbon AI Insights | ESG, Net Zero & Climate Tech')
@section('meta_description', 'Read expert insights on ESG software, carbon accounting, and climate tech. See how Carbon AI drives the net-zero transition with verified sustainability data.')

@php
    use Illuminate\Support\Str;

    $activeTab = 'all';
    if(request()->has('carbon-accounting-page')) {
        $activeTab = 'carbon-accounting';
    } elseif(request()->has('hospitality-page')) {
        $activeTab = 'hospitality';
    } elseif(request()->has('net-zero-page')) {
        $activeTab = 'net-zero';
    } elseif(request()->has('regulations-page')) {
        $activeTab = 'regulations';
    }
@endphp

@section('content')
<div>
    <div class="blogs-bg">
        <div class="green-ball">
            <img src="{{ asset('images/home/greenball.png') }}" style="max-width: 100%;">
        </div>
        <div class="container">
            <div class="row-centered">
                <div class="header">
                    <h1>Blogs</h1>
                    <h3>Turning sustainability intelligence into action.</h3>
                    <h3>Explore insights on carbon accounting software, ESG reporting, decarbonization, climate technology, and the path to Net Zero.</h3>
                </div>
            </div>
        </div>
    </div>

    <img src="/images/home/greenball-side.png" style="max-width: 100%; position: absolute; right: 0; top: 80%;">

    <div id="blogs-wrapper">
        <!-- Blog Tabs Section - Desktop -->
        <div id="blogs-section" class="blog-tabs-section d-none d-md-block">
            <div class="container p-0">
                <!-- Tab Navigation -->
                <div class="tab-navigation">
                    <button class="tab-btn {{ $activeTab === 'all' ? 'active' : '' }}" onclick="showTab('all')">All</button>
                    <button class="tab-btn {{ $activeTab === 'carbon-accounting' ? 'active' : '' }}" onclick="showTab('carbon-accounting')">Carbon Accounting</button>
                    <button class="tab-btn {{ $activeTab === 'hospitality' ? 'active' : '' }}" onclick="showTab('hospitality')">Hospitality & Tourism</button>
                    <button class="tab-btn {{ $activeTab === 'net-zero' ? 'active' : '' }}" onclick="showTab('net-zero')">Net Zero & Strategy</button>
                    <button class="tab-btn {{ $activeTab === 'regulations' ? 'active' : '' }}" onclick="showTab('regulations')">Regulations & Disclosure</button>
                </div>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- All Blogs Tab -->
                    <div id="all" class="tab-panel {{ $activeTab === 'all' ? 'active' : '' }}">
                        <div id="blog-content" class="blog-cards-grid p-0">
                            @forelse($blogs as $post)
                                <div class="blog-card">
                                    <div class="blog-card-image">
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="blog-card-content">
                                        <div class="blog-content-wrapper">
                                            <div class="author mt-3">
                                                <div class="blog-author">{{ optional($post->user)->name ?? 'Admin' }}</div>
                                                <div class="blog-date">{{ $post->created_at->format('M d, Y') }}</div>
                                            </div>
                                            <h3 class="blog-title">{{ $post->title }}</h3>
                                            <p class="blog-excerpt">{{ Str::limit(strip_tags(html_entity_decode($post->content)), 180) }}</p>
                                        </div>
                                        <h6 class="blog-read-more">
                                            <a href="{{ route('article.show', $post) }}" style="color: inherit; text-decoration: none;">Read More</a>
                                            <img src="{{ asset('images/home/arrow.svg') }}" alt="Arrow">
                                        </h6>
                                    </div>
                                </div>
                            @empty
                                <div class="blog-empty">No blog posts yet. Check back soon.</div>
                            @endforelse
                        </div>

                        @if($blogs->hasPages())
                            <div class="pagination-wrapper mt-4" id="blog-pagination">
                                {{ $blogs->links('vendor.pagination.simple') }}
                            </div>
                        @endif
                    </div>

                    <!-- Carbon Accounting Tab -->
                    <div id="carbon-accounting" class="tab-panel {{ $activeTab === 'carbon-accounting' ? 'active' : '' }}">
                        <div class="blog-cards-grid">
                            @forelse($carbonAccountingBlogs as $post)
                                <div class="blog-card">
                                    <div class="blog-card-image">
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="blog-card-content">
                                        <div class="blog-content-wrapper">
                                            <div class="author mt-3">
                                                <div class="blog-author">{{ optional($post->user)->name ?? 'Admin' }}</div>
                                                <div class="blog-date">{{ $post->created_at->format('M d, Y') }}</div>
                                            </div>
                                            <h3 class="blog-title">{{ $post->title }}</h3>
                                            <p class="blog-excerpt">{{ Str::limit(strip_tags(html_entity_decode($post->content)), 180) }}</p>
                                        </div>
                                        <h6 class="blog-read-more">
                                            <a href="{{ route('article.show', $post) }}" style="color: inherit; text-decoration: none;">Read More</a>
                                            <img src="{{ asset('images/home/arrow.svg') }}" alt="Arrow">
                                        </h6>
                                    </div>
                                </div>
                            @empty
                                <div class="blog-empty">No blog posts in this category yet.</div>
                            @endforelse
                        </div>

                        @if($carbonAccountingBlogs->hasPages())
                            <div class="pagination-wrapper mt-4">
                                {{ $carbonAccountingBlogs->links('vendor.pagination.simple') }}
                            </div>
                        @endif
                    </div>

                    <!-- Hospitality & Tourism Tab -->
                    <div id="hospitality" class="tab-panel {{ $activeTab === 'hospitality' ? 'active' : '' }}">
                        <div class="blog-cards-grid">
                            @forelse($hospitalityBlogs as $post)
                                <div class="blog-card">
                                    <div class="blog-card-image">
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="blog-card-content">
                                        <div class="blog-content-wrapper">
                                            <div class="author mt-3">
                                                <div class="blog-author">{{ optional($post->user)->name ?? 'Admin' }}</div>
                                                <div class="blog-date">{{ $post->created_at->format('M d, Y') }}</div>
                                            </div>
                                            <h3 class="blog-title">{{ $post->title }}</h3>
                                            <p class="blog-excerpt">{{ Str::limit(strip_tags(html_entity_decode($post->content)), 180) }}</p>
                                        </div>
                                        <h6 class="blog-read-more">
                                            <a href="{{ route('article.show', $post) }}" style="color: inherit; text-decoration: none;">Read More</a>
                                            <img src="{{ asset('images/home/arrow.svg') }}" alt="Arrow">
                                        </h6>
                                    </div>
                                </div>
                            @empty
                                <div class="blog-empty">No blog posts in this category yet.</div>
                            @endforelse
                        </div>

                        @if($hospitalityBlogs->hasPages())
                            <div class="pagination-wrapper mt-4">
                                {{ $hospitalityBlogs->links('vendor.pagination.simple') }}
                            </div>
                        @endif
                    </div>

                    <!-- Net Zero Tab -->
                    <div id="net-zero" class="tab-panel {{ $activeTab === 'net-zero' ? 'active' : '' }}">
                        <div class="blog-cards-grid">
                            @forelse($netZeroBlogs as $post)
                                <div class="blog-card">
                                    <div class="blog-card-image">
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="blog-card-content">
                                        <div class="blog-content-wrapper">
                                            <div class="author mt-3">
                                                <div class="blog-author">{{ optional($post->user)->name ?? 'Admin' }}</div>
                                                <div class="blog-date">{{ $post->created_at->format('M d, Y') }}</div>
                                            </div>
                                            <h3 class="blog-title">{{ $post->title }}</h3>
                                            <p class="blog-excerpt">{{ Str::limit(strip_tags(html_entity_decode($post->content)), 180) }}</p>
                                        </div>
                                        <h6 class="blog-read-more">
                                            <a href="{{ route('article.show', $post) }}" style="color: inherit; text-decoration: none;">Read More</a>
                                            <img src="{{ asset('images/home/arrow.svg') }}" alt="Arrow">
                                        </h6>
                                    </div>
                                </div>
                            @empty
                                <div class="blog-empty">No blog posts in this category yet.</div>
                            @endforelse
                        </div>

                        @if($netZeroBlogs->hasPages())
                            <div class="pagination-wrapper mt-4">
                                {{ $netZeroBlogs->links('vendor.pagination.simple') }}
                            </div>
                        @endif
                    </div>

                    <!-- Regulations Tab -->
                    <div id="regulations" class="tab-panel {{ $activeTab === 'regulations' ? 'active' : '' }}">
                        <div class="blog-cards-grid">
                            @forelse($regulationsBlogs as $post)
                                <div class="blog-card">
                                    <div class="blog-card-image">
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="blog-card-content">
                                        <div class="blog-content-wrapper">
                                            <div class="author mt-3">
                                                <div class="blog-author">{{ optional($post->user)->name ?? 'Admin' }}</div>
                                                <div class="blog-date">{{ $post->created_at->format('M d, Y') }}</div>
                                            </div>
                                            <h3 class="blog-title">{{ $post->title }}</h3>
                                            <p class="blog-excerpt">{{ Str::limit(strip_tags(html_entity_decode($post->content)), 180) }}</p>
                                        </div>
                                        <h6 class="blog-read-more">
                                            <a href="{{ route('article.show', $post) }}" style="color: inherit; text-decoration: none;">Read More</a>
                                            <img src="{{ asset('images/home/arrow.svg') }}" alt="Arrow">
                                        </h6>
                                    </div>
                                </div>
                            @empty
                                <div class="blog-empty">No blog posts in this category yet.</div>
                            @endforelse
                        </div>

                        @if($regulationsBlogs->hasPages())
                            <div class="pagination-wrapper mt-4">
                                {{ $regulationsBlogs->links('vendor.pagination.simple') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Blog Cards - 2x2 Grid -->
        <div class="blog-tabs-section-mobile d-block d-md-none">
            <div class="container p-0">
                <!-- Tab Navigation -->
                <div class="tab-navigation">
                    <button class="tab-btn {{ $activeTab === 'all' ? 'active' : '' }}" onclick="showTabMobile('all')">All</button>
                    <button class="tab-btn {{ $activeTab === 'carbon-accounting' ? 'active' : '' }}" onclick="showTabMobile('carbon-accounting')">Carbon Accounting</button>
                    <button class="tab-btn {{ $activeTab === 'hospitality' ? 'active' : '' }}" onclick="showTabMobile('hospitality')">Hospitality &amp; Tourism</button>
                    <button class="tab-btn {{ $activeTab === 'net-zero' ? 'active' : '' }}" onclick="showTabMobile('net-zero')">Net Zero &amp; Strategy</button>
                    <button class="tab-btn {{ $activeTab === 'regulations' ? 'active' : '' }}" onclick="showTabMobile('regulations')">Regulations &amp; Disclosure</button>
                </div>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- All Blogs Tab -->
                    <div id="all-mobile" class="tab-panel {{ $activeTab === 'all' ? 'active' : '' }}">
                        <div class="blog-cards-grid-mobile p-0">
                            @forelse($blogs as $post)
                                <div class="blog-card-mobile">
                                    <div class="blog-card-image-mobile">
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="blog-card-content-mobile">
                                        <div class="author-mobile mt-3">
                                            <div class="blog-author-mobile">{{ optional($post->user)->name ?? 'Admin' }}</div>
                                            <div class="blog-date-mobile">{{ $post->created_at->format('M d, Y') }}</div>
                                        </div>
                                        <h3 class="blog-title-mobile">{{ $post->title }}</h3>
                                        <p class="blog-excerpt-mobile">{{ Str::limit(strip_tags(html_entity_decode($post->content)), 120) }}</p>
                                        <h6 class="blog-read-more-mobile">
                                            <a href="{{ route('article.show', $post) }}" style="color: inherit; text-decoration: none;">Read More</a>
                                            <img src="{{ asset('images/home/arrow.svg') }}" alt="Arrow">
                                        </h6>
                                    </div>
                                </div>
                            @empty
                                <div class="blog-empty">No blog posts yet. Check back soon.</div>
                            @endforelse
                        </div>

                        @if($blogs->hasPages())
                            <div class="pagination-wrapper mt-4">
                                {{ $blogs->links('vendor.pagination.simple') }}
                            </div>
                        @endif
                    </div>

                    <!-- Carbon Accounting Tab Mobile -->
                    <div id="carbon-accounting-mobile" class="tab-panel {{ $activeTab === 'carbon-accounting' ? 'active' : '' }}">
                        <div class="blog-cards-grid-mobile">
                            @forelse($carbonAccountingBlogs as $post)
                                <div class="blog-card-mobile">
                                    <div class="blog-card-image-mobile">
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="blog-card-content-mobile">
                                        <div class="author-mobile mt-3">
                                            <div class="blog-author-mobile">{{ optional($post->user)->name ?? 'Admin' }}</div>
                                            <div class="blog-date-mobile">{{ $post->created_at->format('M d, Y') }}</div>
                                        </div>
                                        <h3 class="blog-title-mobile">{{ $post->title }}</h3>
                                        <p class="blog-excerpt-mobile">{{ Str::limit(strip_tags(html_entity_decode($post->content)), 120) }}</p>
                                        <h6 class="blog-read-more-mobile">
                                            <a href="{{ route('article.show', $post) }}" style="color: inherit; text-decoration: none;">Read More</a>
                                            <img src="{{ asset('images/home/arrow.svg') }}" alt="Arrow">
                                        </h6>
                                    </div>
                                </div>
                            @empty
                                <div class="blog-empty">No blog posts in this category yet.</div>
                            @endforelse
                        </div>

                        @if($carbonAccountingBlogs->hasPages())
                            <div class="pagination-wrapper mt-4">
                                {{ $carbonAccountingBlogs->links('vendor.pagination.simple') }}
                            </div>
                        @endif
                    </div>

                    <!-- Hospitality Tab Mobile -->
                    <div id="hospitality-mobile" class="tab-panel {{ $activeTab === 'hospitality' ? 'active' : '' }}">
                        <div class="blog-cards-grid-mobile">
                            @forelse($hospitalityBlogs as $post)
                                <div class="blog-card-mobile">
                                    <div class="blog-card-image-mobile">
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="blog-card-content-mobile">
                                        <div class="author-mobile mt-3">
                                            <div class="blog-author-mobile">{{ optional($post->user)->name ?? 'Admin' }}</div>
                                            <div class="blog-date-mobile">{{ $post->created_at->format('M d, Y') }}</div>
                                        </div>
                                        <h3 class="blog-title-mobile">{{ $post->title }}</h3>
                                        <p class="blog-excerpt-mobile">{{ Str::limit(strip_tags(html_entity_decode($post->content)), 120) }}</p>
                                        <h6 class="blog-read-more-mobile">
                                            <a href="{{ route('article.show', $post) }}" style="color: inherit; text-decoration: none;">Read More</a>
                                            <img src="{{ asset('images/home/arrow.svg') }}" alt="Arrow">
                                        </h6>
                                    </div>
                                </div>
                            @empty
                                <div class="blog-empty">No blog posts in this category yet.</div>
                            @endforelse
                        </div>

                        @if($hospitalityBlogs->hasPages())
                            <div class="pagination-wrapper mt-4">
                                {{ $hospitalityBlogs->links('vendor.pagination.simple') }}
                            </div>
                        @endif
                    </div>

                    <!-- Net Zero Tab Mobile -->
                    <div id="net-zero-mobile" class="tab-panel {{ $activeTab === 'net-zero' ? 'active' : '' }}">
                        <div class="blog-cards-grid-mobile">
                            @forelse($netZeroBlogs as $post)
                                <div class="blog-card-mobile">
                                    <div class="blog-card-image-mobile">
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="blog-card-content-mobile">
                                        <div class="author-mobile mt-3">
                                            <div class="blog-author-mobile">{{ optional($post->user)->name ?? 'Admin' }}</div>
                                            <div class="blog-date-mobile">{{ $post->created_at->format('M d, Y') }}</div>
                                        </div>
                                        <h3 class="blog-title-mobile">{{ $post->title }}</h3>
                                        <p class="blog-excerpt-mobile">{{ Str::limit(strip_tags(html_entity_decode($post->content)), 120) }}</p>
                                        <h6 class="blog-read-more-mobile">
                                            <a href="{{ route('article.show', $post) }}" style="color: inherit; text-decoration: none;">Read More</a>
                                            <img src="{{ asset('images/home/arrow.svg') }}" alt="Arrow">
                                        </h6>
                                    </div>
                                </div>
                            @empty
                                <div class="blog-empty">No blog posts in this category yet.</div>
                            @endforelse
                        </div>

                        @if($netZeroBlogs->hasPages())
                            <div class="pagination-wrapper mt-4">
                                {{ $netZeroBlogs->links('vendor.pagination.simple') }}
                            </div>
                        @endif
                    </div>

                    <!-- Regulations Tab Mobile -->
                    <div id="regulations-mobile" class="tab-panel {{ $activeTab === 'regulations' ? 'active' : '' }}">
                        <div class="blog-cards-grid-mobile">
                            @forelse($regulationsBlogs as $post)
                                <div class="blog-card-mobile">
                                    <div class="blog-card-image-mobile">
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="blog-card-content-mobile">
                                        <div class="author-mobile mt-3">
                                            <div class="blog-author-mobile">{{ optional($post->user)->name ?? 'Admin' }}</div>
                                            <div class="blog-date-mobile">{{ $post->created_at->format('M d, Y') }}</div>
                                        </div>
                                        <h3 class="blog-title-mobile">{{ $post->title }}</h3>
                                        <p class="blog-excerpt-mobile">{{ Str::limit(strip_tags(html_entity_decode($post->content)), 120) }}</p>
                                        <h6 class="blog-read-more-mobile">
                                            <a href="{{ route('article.show', $post) }}" style="color: inherit; text-decoration: none;">Read More</a>
                                            <img src="{{ asset('images/home/arrow.svg') }}" alt="Arrow">
                                        </h6>
                                    </div>
                                </div>
                            @empty
                                <div class="blog-empty">No blog posts in this category yet.</div>
                            @endforelse
                        </div>

                        @if($regulationsBlogs->hasPages())
                            <div class="pagination-wrapper mt-4">
                                {{ $regulationsBlogs->links('vendor.pagination.simple') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom - Desktop Version -->
    <div class="container bottom d-none d-md-block">
        <h2>Join Our Waitlist</h2>
        <div class="my-5">
            <a href="{{ url('/waitlist') }}" class="start-for-free-btn">Start for Free</a>
            <a href="{{ url('/waitlist') }}" class="request-demo-btn">Request a Demo</a>
        </div>
    </div>

    <!-- Bottom - Mobile Version -->
    <div class="container bottom-mobile d-flex d-md-none mb-5">
        <div class="bottom-card-mobile">
            <h2>Join Our Waitlist</h2>
            <div class="bottom-buttons mt-4" style="display: flex; flex-direction: column; align-items: center;">
                <a href="{{ url('/waitlist') }}" class="start-for-free-btn">Start for Free</a>
                <a href="{{ url('/waitlist') }}" class="request-demo-btn mt-3">Request a Demo</a>
            </div>
        </div>
    </div>
</div>

<script>
function showTab(tabId) {
    const panels = document.querySelectorAll('.tab-panel');
    panels.forEach(panel => {
        panel.classList.remove('active');
    });

    const buttons = document.querySelectorAll('.tab-btn');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    const selectedPanel = document.getElementById(tabId);
    if (selectedPanel) {
        selectedPanel.classList.add('active');
    }

    const clickedButton = event.target;
    clickedButton.classList.add('active');
}

function showTabMobile(tabId) {
    const panels = document.querySelectorAll('.tab-panel');
    panels.forEach(panel => {
        panel.classList.remove('active');
    });

    const buttons = document.querySelectorAll('.tab-btn');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    const selectedPanel = document.getElementById(tabId + '-mobile');
    if (selectedPanel) {
        selectedPanel.classList.add('active');
    }

    const clickedButton = event.target;
    clickedButton.classList.add('active');
}

document.addEventListener('DOMContentLoaded', function () {
    function attachPaginationHandlers() {
        document.querySelectorAll('[data-pagination] a.blog-pagination-link').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const url = this.getAttribute('href');

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(function (response) {
                    return response.text();
                })
                .then(function (html) {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newWrapper = doc.getElementById('blogs-wrapper');
                    const currentWrapper = document.getElementById('blogs-wrapper');

                    if (newWrapper && currentWrapper) {
                        currentWrapper.innerHTML = newWrapper.innerHTML;
                        history.pushState({}, '', url);

                        const section = document.getElementById('blogs-section');
                        if (section) {
                            section.scrollIntoView({ behavior: 'auto', block: 'start' });
                        }

                        attachPaginationHandlers();
                    }
                })
                .catch(function (error) {
                    console.error('Pagination load failed:', error);
                    window.location.href = url;
                });
            });
        });
    }

    attachPaginationHandlers();
});
</script>
@endsection
