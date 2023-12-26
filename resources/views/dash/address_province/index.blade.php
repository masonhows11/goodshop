@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.province_management') }}
@endsection
@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('admin.delivery.create') }}--}}
@endsection
@section('dash_main_content')

    <div class="container-fluid">


        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3>{{ __('messages.addresses') }} / {{ __('messages.province_management') }}</h3>
                </div>
            </div>
        </div>

        <div class="row create-province my-4 bg-white">

            <div class="col-lg-5 mb-3 mt-3">
                <form action="{{ route('admin.province.store') }}" method="post">
                    @csrf

                    <div class="mb-2 mt-2">
                        <label for="province">{{ __('messages.name') }}</label>
                        <input type="text" id="province" class="form-control @error('name') is-invalid @enderror mt-2" name="name" value="{{ old('name') }}">
                    </div>

                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="mb-2 mt-2">
                        <div>
                            <input type="submit" class="btn btn-success mt-4 " value="{{ __('messages.save') }}">
                        </div>
                    </div>

                </form>
            </div>
        </div>


        <div class="row  list-provinces bg-white mb-4" style="height: 320px">
            <div class="my-5">

                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.title') }}</th>
                        <th>{{ __('messages.add_city') }}</th>
                        <th>{{ __('messages.edit_model') }}</th>
                        <th>{{ __('messages.delete_model') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $provinces as $item )
                        <tr class="text-center">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td><a href="{{ route('admin.city.create',['id'=>$item->id]) }}" class="btn btn-success btn-sm">{{ __('messages.add_city') }}</a></td>
                            <td><a href="{{ route('admin.province.edit',[$item->id]) }}" class="btn btn-primary btn-sm">{{ __('messages.edit_model') }}</a></td>
                            <td>
                                <form action="{{ route('admin.province.delete',$item->id) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger delete-item">{{ __('messages.delete_model') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="row d-flex justify-content-center bg-white">
            <div class="col-lg-2 col-md-2 my-3 py-3">
                {{ $provinces->links() }}
            </div>
        </div>

    </div>
@endsection
