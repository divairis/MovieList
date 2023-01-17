<div class="product__pagination">
    @if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <a rel="prev">
                <i class="fa fa-angle-double-left"></i>
            </a>
            @else
            <li class="page-item">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <i class="fa fa-angle-double-left"></i>
                </a>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">
                    {{ $element }}
                </span>
            </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <a class="current-page">{{ $page }}</a>
            @else
            <a href="{{ $url }}">{{ $page }}</a>
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                <i class="fa fa-angle-double-right"></i>
            </a>
            @else
            <a rel="next">
                <i class="fa fa-angle-double-right"></i>
            </a>
            @endif
        </ul>
    </nav>
    @endif
</div>
