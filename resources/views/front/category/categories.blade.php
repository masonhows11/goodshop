<div class="ps-0 d-flex flex-column accordion-item">
    @foreach( $categories as $child )
        <div class="d-flex mt-2 flex-row">
            @if( $child->children->count() > 0)
                <i data-bs-toggle="collapse"
                   data-bs-target="#collapseOne"
                   aria-expanded="true"
                   aria-controls="collapseOne" class="font-11 mt-1 ms-2 fa fa-xs fa-chevron-left"></i>
            @endif
            <span class="ms-2">
            <a href="{{ route('search.category',['slug' => $child->slug]) }}" class="font-12 d-inline">{{ $child->title_persian }}</a>
        </span>
        </div>
        <div id="collapseOne" class="ms-4 accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            @include('front.category.child_categories',['category' => $child->children])
        </div>
    @endforeach
</div>
