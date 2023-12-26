@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.amazing_sales_list') }}
@endsection
@section('dash_main_content')
    <div class="container-fluid">

        <livewire:admin.admin-amazing-sale/>

    </div>
@endsection


