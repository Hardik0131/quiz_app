@if ($paginator->hasPages())
    <nav class="custom-pagination">
        <ul>
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="disabled">‹ Previous</li>
            @else
                <a href="{{ $paginator->previousPageUrl() }}">
                    <li>
                        ‹ Previous
                    </li>
                </a>
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
                            <a href="{{ $url }}">
                                <li>
                                    {{ $page }}
                                </li>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}">
                    <li>
                        Next ›
                    </li>
                </a>
            @else
                <li class="disabled">Next ›</li>
            @endif
        </ul>
    </nav>
@endif
