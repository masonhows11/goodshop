@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.modify_stock') }}
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.product.edit.stock',$product->title_persian) }}
@endsection
@section('dash_main_content')
    <div class="container-fluid bg-white py-4">


        <div class="row d-flex justify-content-start my-4">
            <div class="col-lg-2 col-md-2  my-5 col border-bottom title-add-to-stock">
                <div class="alert my-4 text-center">
                    <h3> {{ __('messages.modify_stock') }}</h3>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.modify_stock') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row border border-2 mb-5">

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="col-sm-6 mt-5 mb-5">
                    <label for="available_in_stock" class="form-label">{{ __('messages.available_in_stock') }}</label>
                    <input type="text"
                           name="available_in_stock"
                           id="available_in_stock"
                           class="form-control"
                           value="{{ $product->available_in_stock}}">
                    @error('available_in_stock')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-sm-6 mt-5 mb-5">
                    <label for="salable_quantity" class="form-label">{{ __('messages.salable_quantity') }}</label>
                    <input type="text"
                           name="salable_quantity"
                           id="salable_quantity"
                           class="form-control"
                           value="{{ $product->salable_quantity}}">
                    @error('salable_quantity')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="col-sm-6 mt-5 mb-5">
                    <label for="number_sold" class="form-label">{{ __('messages.number_sold') }}</label>
                    <input type="text"
                           class="form-control"
                           id="number_sold"
                           name="number_sold"
                           value="{{ $product->number_sold }}">
                    @error('number_sold')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-sm-6 mt-5 mb-5">
                    <label for="frozen_number" class="form-label">{{ __('messages.frozen_number') }}</label>
                    <input type="text"
                           class="form-control"
                           id="frozen_number"
                           name="frozen_number"
                           value="{{ $product->frozen_number }}">
                    @error('frozen_number')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>






                <div class="row my-4 mx-2">
                    <div class="col d-flex justify-content-start">
                        <div>
                            <button type="submit" class="btn btn-success">{{ __('messages.save') }}</button>
                        </div>
                        <div class="ms-2">
                            <a href="{{ route('admin.stock.product.index') }}" class="btn btn-secondary">لیست محصولات</a>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
@endsection
