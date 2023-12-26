@extends('front.profile.master_profile')
@section('page_title')
    {{ __('messages.ticket') .' '. $ticket->subject }}
@endsection
@section('left_profile_content')

    <div class="profile-card">

        <div class="row d-flex flex-column mt-2">
            <div class="col-lg-4 my-2">
                <a href="{{ route('tickets') }}" class="btn btn-sm btn-primary">{{ __('messages.return') }}</a>
            </div>
            <div class="col my-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title my-2">{{ __('messages.subject') }} : {{ $ticket->subject }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text my-2">{{ __('messages.description') }} : {{ $ticket->description }}</p>
                        <div>
                            @if( $ticket->file != null)
                                <a href="{{ asset('storage/'.$ticket->file->file_path) }}" download class="btn btn-sm btn-primary font-12"><i class="fa-solid fa-download me-2 "></i>{{ __('messages.download') }}</a>

                                {{-- <a href="{{ route('ticket.download',$ticket->id) }}" class="btn btn-sm btn-primary font-12"><i class="fa-solid fa-download me-2 "></i>{{ __('messages.download') }}</a>--}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @foreach( $ticket->child as $item )
                <div class="col my-2">
                    <div class="card me-4">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h6 class="h6 card-title my-auto">{{ $item->user->first_name . ' ' . $item->user->last_name }}</h6>
                            </div>
                            <div>
                                <p class="my-auto"> ادمین : {{ $item->admin != null ? $item->admin->admin->first_name .' ' . $item->admin->admin->last_name : __('messages.unknown')  }} </p>
                            </div>
                            <div>
                                <p class="my-auto"> تاریخ : {{ jdate($item->created_at) }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text my-2">{{ __('messages.description') }} : {{ $item->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if( $ticket->status == 0)
        <div class="row  mt-2">
            <form action="{{ route('answer.ticket',$ticket->id) }}" method="post">
                @csrf
                <div class="row product-stock-list mt-2 py-2">
                    <div class="col">
                        <div class="mt-2">
                            <label for=description"
                                   class="form-label font-20">{{ __('messages.response_ticket') }}</label>
                            <textarea class="form-control" rows="6" id="description" name="description"></textarea>
                        </div>
                        @error('description')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-12 discount-common-save">
                        <div class="mt-3">
                            <input type="submit" class="btn btn-success" value="{{ __('messages.save') }}">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @else
        <div class="row d-flex justify-content-center">
            <div class="col h-75 my-4 mx-2 bg-light rounded">
                <p class="text-center my-4">{{ __('messages.ticket_closed') }}</p>
            </div>
        </div>
        @endif

    </div>
@endsection


