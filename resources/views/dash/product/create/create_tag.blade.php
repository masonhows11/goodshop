@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.product_tags') }}
@endsection
@section('dash_main_content')
    <div class="container-fluid">
        <livewire:admin.create-product.create-product-tag :product_id="$product_id"/>
    </div>
@endsection
