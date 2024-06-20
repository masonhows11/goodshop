@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.product_colors') }}
@endsection
@section('dash_main_content')
    <div class="container-fluid">

        <livewire:admin.create-product.create-product-default-color :product="$product" :colors="$colors"/>

        <livewire:admin.create-product.create-product-color :product="$product" :colors="$colors"/>

    </div>
@endsection



