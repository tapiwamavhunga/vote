@if ($paginator->hasPages()) 
    <nav class="navigation align-center">

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="page-numbers bg-border-color current" href="#"><span>{{ $page }}</span></a>
                    @else
                        <a class="page-numbers bg-border-color" href="{{ $url }}"><span>{{ $page }}</span></a>
                    @endif
                @endforeach
            @endif
        @endforeach

    </nav>
@endif
