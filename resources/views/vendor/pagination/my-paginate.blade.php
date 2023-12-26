@if ($paginator->hasPages())
    <nav aria-label="Page   example">
        <ul class="custom-pagination justify-content-center">

            @if ($paginator->onFirstPage())
                <li class="custom-disabled">
                    <a class="" href="#"
                       tabindex="-1"><i class="fa fa-angle-right align-middle"></i></a>
                </li>
            @else
                <li class="">
                    <a class="" href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-right align-middle"></i></a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="custom-disabled">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active">
                                <a class="">{{ $page }}</a>
                            </li>
                        @else
                            <li class="">
                                <a class="" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="">
                    <a class=""
                       href="{{ $paginator->nextPageUrl() }}"
                       rel="next"><i class="fa fa-angle-left align-middle"></i></a>
                </li>
            @else
                <li class="custom-disabled">
                    <a class="" href="#"><i class="fa fa-angle-left align-middle"></i></a>
                </li>
            @endif

        </ul>
    </nav>
@endif
