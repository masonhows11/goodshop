@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.edit_category_ticket') }}
@endsection
@section('breadcrumb')
    {{--  {{ Breadcrumbs::render('') }}--}}
@endsection

@section('dash_main_content')

    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3> {{ __('messages.edit_category_ticket') }}</h3>
                </div>
            </div>
        </div>

        <div class="row my-4 bg-white">
            <div class="col-lg-4 col-md-4 col my-2">
                <a href="{{ route('admin.category.tickets') }}" class="btn btn-sm btn-primary">{{ __('messages.category_tickets') }}</a>
            </div>
        </div>


        <form action="{{ route('admin.category.ticket.update') }}" method="post">
            @csrf
            <div class="row product-stock-list mt-5 py-5 bg-white">

                <input type="hidden" name="ticket" value="{{ $category->id }}">
                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for=name" class="form-label">{{ __('messages.name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                    </div>
                    @error('name')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="status" class="form-label">{{ __('messages.status') }}</label>
                        <select name="status" class="form-select" id="status">
                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }} >{{ __('messages.deactivate') }}</option>
                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>{{ __('messages.active') }}</option>
                        </select>
                    </div>
                    @error('status')
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
@endsection



