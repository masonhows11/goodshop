<p class="mt-3 mx-3 font-14">
    <i class="fa fa-chevron-left align-middle text-danger font-12 me-1"></i> مشخصات فنی
</p>
@foreach( $product->values()->get() as $value )
    <div class="row mx-3">
        <div class="col-sm-4 mb-2">
            <div class="box-line">{{ $value->attribute->title }}</div>
        </div>
        <div class="col-sm-8 mb-2">
            <div
                class="box-line">{{ $value->value }} {{ $value->attribute->unit }}</div>
        </div>
    </div>
@endforeach
