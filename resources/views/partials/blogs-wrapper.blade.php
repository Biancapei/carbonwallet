@php
    use Illuminate\Support\Str;
@endphp

<input type="hidden" name="current_tab" value="{{ $activeTab }}">

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
