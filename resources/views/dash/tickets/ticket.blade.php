@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.tickets') }}
@endsection
@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('') }}--}}
@endsection
@section('dash_main_content')
    <div class="container-fluid">

        <div class="row d-flex flex-column my-4 bg-white">

            <div class="col-lg-4 my-2">
                <a href="{{ route('admin.all.tickets') }}" class="btn btn-sm btn-primary">{{ __('messages.all_tickets') }}</a>
            </div>
            <div class="col-lg-4 col-md-4 col  my-2">
                <div class="alert my-4">
                    <h3>{{ __('messages.ticket') }} : {{ $ticket->subject }}  </h3>
                </div>
            </div>


            <div class="col  mt-2 mb-2 ">
                <div class="card border border-primary">
                    <div class="card-header bg-primary">
                        <p class="my-auto"> {{ __('messages.user') }}: {{ $ticket->user->first_name ?? '-'  }} {{ $ticket->user->last_name ?? '-' }}</p>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title my-2">{{ __('messages.subject') }} : {{ $ticket->subject }}</h5>
                        <p class="card-text my-2">{{ __('messages.description') }} : {{ $ticket->description }}</p>
                    </div>
                </div>
            </div>

            <div class="col  mt-4 mb-4">
                <div class="row d-flex flex-column border border-2  mx-2 my-2">
                    @foreach( $ticket->child as $item )
                            <div class="col my-4">
                                <div class="card border border-1 border-secondary me-4">
                                    <div class="card-header bg-secondary">
                                        <div>
                                            <p class="card-title">{{ $item->user->first_name . ' ' . $item->user->last_name }}</p>
                                            <p class="">تاریح : {{ jdate($item->created_at) }}</p>
                                            <p class=""> ادمین : {{ $item->admin != null ? $item->admin->admin->first_name .' ' . $item->admin->admin->last_name : __('messages.unknown')  }} </p>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text my-2">{{ __('messages.description') }} : {{ $item->description }}</p>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row  my-4 bg-white">

            <div class="bg-secondary  h-50">
              <p class="p-4 my-auto">  {{ __('messages.response_ticket') }}</p>
            </div>
            <div>
                <form action="{{ route('admin.answer.ticket',$ticket->id) }}" method="post">
                    @csrf

                    <div class="row product-stock-list mt-5 py-5 bg-white">

                        <div class="col">
                            <div class="mt-3">
                                <label for=description" class="form-label">{{ __('messages.description') }}</label>
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

        </div>

    </div>
@endsection


