@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.warranty_management') }}
@endsection
@section('dash_main_content')
    <div class="container-fluid">

        <livewire:admin.warranty.admin-warranty :product="$product"/>

    </div>
@endsection
