@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.sms_notification') }}
@endsection
@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('admin.delivery.create') }}--}}
@endsection
@section('dash_main_content')

    <livewire:admin.sms-notice.admin-sms-notice/>

@endsection


