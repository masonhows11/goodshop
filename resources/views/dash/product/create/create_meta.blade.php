@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.product_meta') }}
@endsection
@section('dash_main_content')
    <div class="container-fluid">

        <livewire:admin.create-product.create-product-meta :product="$product"/>

    </div>
@endsection
