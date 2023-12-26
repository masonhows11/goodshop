@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.common_discount_list') }}
@endsection
@section('dash_main_content')
    <div class="container-fluid">

        <livewire:admin.admin-common-discount/>

    </div>
@endsection

