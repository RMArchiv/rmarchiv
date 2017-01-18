@if ($paginator->hasPages())
    <li>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <div class='prevpage'>vorherige seite</div>
            @else
                <div class='prevpage'><a href='{{ $paginator->previousPageUrl() }}'>vorherige seite</a></div>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span>{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span>{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <div class='nextpage'><a href='{{ $paginator->nextPageUrl() }}'>weiter</a></div>
            @else
                <div class='nextpage'>weiter</div>
            @endif
    </li>
@endif
