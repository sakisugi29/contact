@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <div style="display: flex; gap: 4px;">

            {{-- 前のページ --}}
            @if ($paginator->onFirstPage())
                <span class="page-btn disabled">‹</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="page-btn">‹</a>
            @endif

            {{-- 数字 --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="page-btn disabled">{{ $element }}</span>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="page-btn active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- 次のページ --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="page-btn">›</a>
            @else
                <span class="page-btn disabled">›</span>
            @endif

        </div>
    </nav>
@endif