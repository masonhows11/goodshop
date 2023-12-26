@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.attachment_files') }}
@endsection
@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('admin.delivery.create') }}--}}
@endsection
@section('dash_main_content')

    <livewire:admin.email-notice-file.admin-email-file :file="$file" />

@endsection

