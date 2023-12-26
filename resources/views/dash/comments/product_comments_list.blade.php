@extends('dash.include.master_dash')
@section('dash_page_title')
       {{ __('messages.management_comments') }}
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('admin.comment.product.list') }}
@endsection

@section('dash_main_content')
    <div class="container-fluid">

        <div class="row mt-4">
            <div class="col-lg-5">
                <div class="alert alert-light mt-5">
                    <h4 class="h4 text-center"><strong>{{ __('messages.management_comments') }}</strong></h4>
                </div>
            </div>
        </div>
        <div class="row mt-4 list-type-brand-assign">

            <div class="col">
                <table class="table table-bordered bg-white rounded-2">
                    <thead>
                    <tr class="text-center">
                        <th>شناسه</th>
                        <th>عنوان ( فارسی )</th>
                        <th>عنوان ( انگلیسی )</th>
                        <th>دیدگاه ها</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr class="text-center">
                            <td>{{ $product->id}}</td>
                            <td>{{ $product->title_persian}}</td>
                            <td>{{ $product->title_english}}</td>
                            <td><a href="{{ route('admin.comments.index.product',['product'=>$product->id]) }}" class="btn btn-success btn-sm">لیست نظرات</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row d-flex justify-content-center my-4">
            <div class="col-lg-2 col-md-2 col-2">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
