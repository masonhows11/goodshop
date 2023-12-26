@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.slider_product_by_category') }}
@endsection
@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('admin.delivery.create') }}--}}
@endsection

@section('dash_main_content')

    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3>{{ __('messages.sliders_management') }} / {{ __('messages.slider_product_by_category') }}</h3>
                </div>
            </div>
        </div>

        <div class="row  delivery-list bg-white">
            <div class="my-5">

                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.category') }}</th>
                        <th>{{ __('messages.description') }}</th>
                        <th>{{ __('messages.operation') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $productByCategory as $item)
                        <tr class="text-center">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->category_name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <form action="{{ route('admin.product.category.destroy',$item->id) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger delete-item">{{ __('messages.delete_model') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>


        <div class="row bg-white p-5 mt-4">
            <form action="{{ route('admin.product.category.store') }}" id="create-form" method="post">
                @csrf

                <div class="mt-3">
                    <label for="category-id" class="form-label">{{ __('messages.category') }}</label>
                    <select name="category" class="form-select" id="category-id">
                        <option value="" disabled selected hidden>{{ __('messages.choose') }}</option>
                        @foreach( $categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title_persian }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category')
                <div class="alert alert-danger mt-3">
                    {{ $message }}
                </div>
                @enderror


                <div class="mt-3">
                    <input type="submit" class="btn btn-success" value="{{ __('messages.save') }}">
                </div>

            </form>
        </div>


    </div>
@endsection




