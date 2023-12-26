@foreach( $category as $child )
    <ul class="me-3">
        <li class="d-flex flex-row ">
            @if( $child->children->count() > 0)
                <i  class="font-11 mt-1 me-3 fa fa-xs fa-chevron-left"></i>
            @endif
           <span><a class="font-12 mt-1 child-category link-dark text-decoration-none" href="{{ route('search.category',['slug' => $child->slug]) }}">{{ $child->title_persian }}</a></span>
        </li>
        @if( $child->children != null  )
            @include('front.partials.child_category',['category' => $child->children])
        @endif
    </ul>
@endforeach

