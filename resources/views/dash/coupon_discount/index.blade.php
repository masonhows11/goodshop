@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.coupon_discount_list') }}
@endsection
@section('dash_main_content')
    <div class="container-fluid">

        <livewire:admin.admin-coupon-discount/>

    </div>
@endsection


