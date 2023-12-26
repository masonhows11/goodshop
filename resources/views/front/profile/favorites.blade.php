@extends('front.profile.master_profile')
@section('page_title')
    {{ __('messages.favorites_list') }}
@endsection
@section('left_profile_content')

    <div class="profile-card">
        <p class="font-13">لیست علاقه‌مندی‌ها</p>
        <div class="row">

            @if (  count($products) > 0 )
                @foreach( $products as $product)
                    <div class="col-md-6">
                        <div class="border rounded d-flex mb-3 fav-item pe-1">
                            <a href="{{ route('product.details',$product) }}"><img src="{{ asset('storage/' . $product->thumbnail_image) }}" alt="product-image - {{ $product->thumbnail_image }}"  class="fav-list-pic"></a>
                            <div class="flex-grow-1">
                                <a href="{{ route('product.details',$product) }}" class="fav-list-title">{{ $product->title_persian }}</a>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <form action="{{ route('favorites.delete', $product) }}" method="get"  class="d-inline favorites-form">
                                            @csrf
                                            <button type="submit" class="delete-item border-0 bg-white"><i class="fa fa-trash  font-13 delete-item" id="delete-item"></i></button>
                                        </form>
                                        <i class="fa fa-cart-plus font-13"></i>

                                    </div>
                                    <a href="{{ route('product.details',$product) }}" class="btn btn-info text-white float-end font-12 m-2 me-4">مشاهده محصول </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col d-flex justify-content-center align-items-center" style="height: 300px">
                    <p class="text-center">{{ __('messages.no_product_found') }}</p>
                </div>
            @endif


        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-3 mt-4">
                {{ $products->links() }}
            </div>
        </div>

        {{--   <ul class="custom-pagination mt-4"><!-- start pagination -->
               <li><a href="#"><i class="fa fa-angle-right align-middle"></i></a></li>
               <li class="active"><a href="#">1</a></li>
               <li><a href="#">2</a></li>
               <li><a href="#">3</a></li>
               <li><a href="#">4</a></li>
               <li><a href="#"><i class="fa fa-angle-left align-middle"></i></a></li>
           </ul><!-- end pagination -->--}}
    </div>
@endsection
