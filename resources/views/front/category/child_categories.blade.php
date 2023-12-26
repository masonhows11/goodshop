@foreach( $category as $child )
            <div class="ms-3 d-flex flex-column">
                <div class="d-flex flex-row">
                    @if( $child->children->count() > 0)
                        <i  class="font-11 mt-1 me-2 fa fa-xs fa-chevron-left"></i>
                    @endif
                     <span>
                         <a class="font-12 mt-2 mb-1 child-category" href="{{ route('search.category',['slug' => $child->slug]) }}">{{ $child->title_persian }}</a>
                    </span>
                </div>
                @if( $child->children != null  )
                        @include('front.category.child_categories',['category' => $child->children])
                @endif
            </div>
@endforeach

