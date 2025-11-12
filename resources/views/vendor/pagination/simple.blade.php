@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="blog-pagination-nav" data-pagination>
        <div class="blog-pagination">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="blog-pagination-ellipsis">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="blog-pagination-link active" aria-current="page">{{ $page }}</span>
                        @else
                            <a class="blog-pagination-link" href="{{ $url }}" data-page="{{ $page }}" data-url="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
    </nav>
@endif
