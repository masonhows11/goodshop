@extends('front.profile.master_profile')
@section('page_title')
    {{ __('messages.tickets') }}
@endsection
@section('left_profile_content')

    <div class="profile-card">

        <div class="row ">
            <div class="col-sm-6">
                <p class="font-20 my-auto">{{ __('messages.all_tickets') }}</p>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="{{ route('new.ticket') }}" class="btn btn-sm btn-secondary rounded">{{ __('messages.new_ticket') }}</a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col profile-list-tickets">
                <table class="table table-striped">
                    <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>{{ __('messages.author_ticket') }}</th>
                        <th>{{ __('messages.title_ticket') }}</th>
                        <th>{{ __('messages.category_ticket') }}</th>
                        <th>{{ __('messages.priority_ticket') }}</th>
                        <th>{{ __('messages.ticket_resource') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.operation') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse( $tickets as $ticket)
                        <tr class="text-center">
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->user->first_name . ' ' . $ticket->user->last_name }}</td>
                            <td>{{ $ticket->subject }}</td>
                            <td>{{ $ticket->category->name }}</td>
                            <td>{{ $ticket->priority->name }}</td>
                            <td>{{ $ticket->parent->subject ?? '-' }}</td>
                            <td>{{ $ticket->status == 0 ? __('messages.ticket_open') : __('messages.ticket_close') }}</td>
                            <td>
                                <a href="{{ route('show.ticket',$ticket->id) }}" class="btn btn-sm btn-primary">{{ __('messages.show_ticket') }}</a>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center" >
                            <td class="text-center">{{ __('messages.not_record_found') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-3 mt-4">
                {{ $tickets->links() }}
            </div>
        </div>



    </div>
@endsection
@push('front_custom_scripts')
    <script>

        $(document).ready(function () {

        })

    </script>
@endpush

