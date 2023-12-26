<p class="mt-4">ویژگی های محصول :</p>
<ul class="font-13 ps-1">
    @foreach( $product->values()->get() as $value )
        <li class="mt-3"><i class="fa fa-check align-middle text-primary me-2"></i>
            {{ $value->attribute->title }} : {{ $value->value }} {{ $value->attribute->unit }}
        </li>
    @endforeach
    @foreach( $product->meta as $item )
        <li class="mt-3"><i class="fa fa-check align-middle text-primary me-2"></i>
            {{ $item->meta_key }} : {{ $item->meta_value }}
        </li>
    @endforeach
</ul>
