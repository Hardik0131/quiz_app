@if ($paginator->hasPages())
    <nav class="custom-pagination">
        <ul>
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="disabled">‹ Previous</li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}">‹ Previous</a>
                </li>
            @endif

            {{-- Page Number --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="dots">{{ $element }}</li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active">{{ $page }}</li>
                        @else
                            <li>
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}">Next ›</a>
                </li>
            @else
                <li class="disabled">Next ›</li>
            @endif
        </ul>
    </nav>
@endif
