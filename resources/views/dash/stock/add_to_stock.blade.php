@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.add_to_stock') }}
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.product.add.stock',$product->title_persian) }}
@endsection

@section('dash_main_content')
    <div class="container-fluid bg-white py-4">


        <div class="row d-flex justify-content-start my-4">
            <div class="col-lg-2 col-md-2  my-5 col border-bottom title-add-to-stock">
                <div class="alert my-4 text-center">
                   <h3> {{ __('messages.add_to_stock') }}</h3>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.add_to_stock') }}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="row border border-2 mb-5">
                <div class="col-sm-6 col-md-6">
                    <div class="row">
                        <div class="col-sm-12 mt-3 mb-3">
                            <label for="recipient" class="form-label">{{ __('messages.name_of_the_recipient') }}</label>
                            <input type="text"
                                   class="form-control"
                                   id="recipient"
                                   name="recipient"
                                   value="{{ old('recipient') }}">
                            @error('recipient')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-sm-12 mt-3 mb-3">
                            <label for="deliver" class="form-label">{{ __('messages.name_of_deliver') }}</label>
                            <input type="text"
                                   class="form-control"
                                   id="deliver"
                                   name="deliver"
                                   value="{{ old('deliver') }}">
                            @error('deliver')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-sm-12 mt-3 mb-3">
                            <label for="numbers" class="form-label">{{ __('messages.available_in_stock') }}</label>
                            <input type="text"
                                   name="numbers"
                                   id="numbers"
                                   class="form-control"
                                   value="{{ old('numbers') }}">
                            @error('numbers')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-sm-12 mt-3 mb-3">
                            <label for="salable_quantity" class="form-label">{{ __('messages.salable_quantity') }}</label>
                            <input type="text"
                                   name="salable_quantity"
                                   id="salable_quantity"
                                   class="form-control"
                                   value="{{ old('salable_quantity') }}">
                            @error('salable_quantity')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="row">
                        <div class="col mt-3 mb-3">
                            <label for=description" class="form-label">{{ __('messages.description') }}</label>
                            <textarea  name="description" rows="11"  class="form-control" id="description">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                </div>


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

        </form>

    </div>

@endsection

