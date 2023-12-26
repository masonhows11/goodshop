@extends('dash.include.master_dash')
@section('dash_page_title')
    لیست نظرات  {{ $product->title_persian  }}
@endsection
@section('dash_main_content')
    <div class="container-fluid product-list-comment-section">

        <livewire:admin.comment.admin-comment :product="$product_id"/>

    </div>
@endsection
