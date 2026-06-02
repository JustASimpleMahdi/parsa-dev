@if ($paginator->hasPages())
    <div class="pagination-wrapper" id="paginationContainer">
        @if($paginator->onFirstPage())
            <div class="pagination-square disabled-nav"><<</div>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-square"><<</a>
        @endif
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <div class="pagination-dots">••</div>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-square active-page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-square">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-square">>></a>
        @else
            <div class="pagination-square disabled-nav">>></div>
        @endif
    </div>
@endif
