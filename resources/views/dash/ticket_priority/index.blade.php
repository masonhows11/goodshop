@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.priority_tickets') }}
@endsection
@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('') }}--}}
@endsection
@section('dash_main_content')
    <div class="container-fluid">

        <livewire:admin.ticket.priority-ticket/>

    </div>
@endsection


