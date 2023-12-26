@foreach($category as $child)
    <li><a class="" href="{{ route('products.category',['slug'=>$child->slug]) }}">{{$child->title_persian}}</a></li>
    @if(count($child->children))
        @include('front.include.child_category',['category'=>$child->children])
    @endif
@endforeach
