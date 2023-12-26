@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.city_management') }}
@endsection
@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('admin.delivery.create') }}--}}
@endsection
@section('dash_main_content')

    <div class="container-fluid">


        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3>{{ __('messages.addresses') }} / {{ __('messages.city_management') }} / {{ __('messages.add_city') }}</h3>
                </div>
                <div class="alert my-4">
                    <h3>{{ __('messages.province') }} : {{ $province->name }} </h3>
                </div>
            </div>
        </div>

        <div class="row d-flex  create-city my-5 bg-white">
            <div class="col-lg-5">
                <form action="{{ route('admin.city.store') }}" method="post">
                    @csrf

                    <input type="hidden" name="province" value="{{ $province->id }}">

                    <div class="mb-2 mt-2">
                        <label for="province">{{ __('messages.name') }}</label>
                        <input type="text" id="province" class="form-control mt-2 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="mb-2 mt-2 d-flex justify-content-between">
                        <div>
                            <input type="submit" class="btn btn-success btn-sm mt-4" value="{{ __('messages.save') }}">
                        </div>
                        <div>
                            <a href="{{ route('admin.province.index') }}" class="btn btn-secondary btn-sm mt-4">{{ __('messages.province_list') }}</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <livewire:admin.city.cities :province="$provinceId"/>



    </div>
@endsection
