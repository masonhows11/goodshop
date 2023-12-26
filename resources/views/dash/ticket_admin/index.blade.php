@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.admin_tickets') }}
@endsection
@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('') }}--}}
@endsection

@section('dash_main_content')

    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3>{{ __('messages.admin_tickets') }} / {{ __('messages.set_admin_for_ticket') }}</h3>
                </div>
            </div>
        </div>

        <div class="row  delivery-list bg-white">
            <div class="my-5">

                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.first_name') }}</th>
                        <th>{{ __('messages.last_name') }}</th>
                        <th>{{ __('messages.email') }}</th>
                        <th>{{ __('messages.operation') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $admins as $admin)
                        <tr class="text-center">
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->first_name }}</td>
                            <td>{{ $admin->last_name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td><a href="{{ route('admin.set.admin.ticket',$admin->id) }}"
                                    class="btn btn-sm {{ $admin->ticketAdmin == null ? ' btn-primary' : 'btn-danger' }}">
                                    {{ $admin->ticketAdmin == null ? __('messages.set_admin') : __('messages.remove_admin')  }}
                                </a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>





    </div>
@endsection


