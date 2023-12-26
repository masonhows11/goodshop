@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.edit_province') }}
@endsection
@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('admin.delivery.create') }}--}}
@endsection
@section('dash_main_content')

    <div class="container-fluid">


        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3>{{ __('messages.addresses') }} / {{ __('messages.edit_province') }}</h3>
                </div>
            </div>
        </div>

        <div class="row create-province my-4 bg-white">

            <div class="col-lg-5 mb-3 mt-3">
                <form action="{{ route('admin.province.update') }}" method="post">
                    @csrf

                    <input type="hidden" name="id" value="{{ $province->id }}">

                    <div class="mb-2 mt-2">
                        <label for="province">{{ __('messages.name') }}</label>
                        <input type="text" id="province" class="form-control mt-2" name="name" value="{{ $province->name }}">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="mb-2 mt-2 d-flex justify-content-between">
                        <div>
                            <input type="submit" class="btn btn-success btn-sm mt-4 " value="{{ __('messages.save') }}">
                        </div>
                        <div>
                            <a href="{{ route('admin.province.index') }}" class="btn btn-secondary btn-sm mt-4">{{ __('messages.return') }}</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
