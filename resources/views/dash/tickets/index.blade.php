@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ $title_page }}
@endsection
@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('') }}--}}
@endsection
@section('dash_main_content')
    <div class="container-fluid">


        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3>{{ $title_page }} </h3>
                </div>
            </div>
        </div>

        <div class="row  tickets-list bg-white">
            <div class="my-5">

                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>#</th>
                        <th>{{ __('messages.author_ticket') }}</th>
                        <th>{{ __('messages.title_ticket') }}</th>
                        <td>{{ __('messages.description') }}</td>
                        <th>{{ __('messages.category_ticket') }}</th>
                        <th>{{ __('messages.priority_ticket') }}</th>
                        <th>{{ __('messages.response_from') }}</th>
                        <th>{{ __('messages.ticket_from') }}</th>
                        <th>{{ __('messages.operation') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $tickets as $ticket)
                        <tr class="text-center">
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->user->name ?? ' - ' }}</td>
                            <td>{{ $ticket->subject }}</td>
                            <td>{{ $ticket->description }}</td>
                            <td>{{ $ticket->category->name  ?? ' - '}}</td>
                            <td>{{ $ticket->priority->name ?? ' - ' }}</td>
                            <td>{{ $ticket->admin != null ? $ticket->admin->admin->first_name . ' ' . $ticket->admin->admin->last_name : __('messages.unknown') }}</td>
                            <td>{{ $ticket->parent->subject ?? '-' }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.show.ticket',$ticket->id) }}">{{ __('messages.show_ticket') }}</a>
                                <a class="btn {{ $ticket->status == 0 ? 'btn-warning' : 'btn-success' }}   btn-sm" href="{{ route('admin.change.status.ticket',$ticket->id) }}">{{ $ticket->status == 0 ? __('messages.ticket_open') : __('messages.ticket_close') }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="row d-flex justify-content-center list-stock-paginate">
            <div class="col-lg-2 col-md-2 ">
                {{ $tickets->links() }}
            </div>
        </div>


    </div>
@endsection

