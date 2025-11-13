@if ($paginator->hasPages())
    <div style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">
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

        @if ($paginator->total() > 0)
            <p class="text-sm text-gray-700 leading-5 dark:text-gray-400" style="margin: 0; text-align: center;">
                Showing
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                to
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-medium">{{ $paginator->total() }}</span>
                results
            </p>
        @endif
    </div>
@endif
