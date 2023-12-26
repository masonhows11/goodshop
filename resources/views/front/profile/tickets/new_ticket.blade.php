@extends('front.profile.master_profile')
@section('page_title')
    {{ __('messages.new_ticket')  }}
@endsection
@section('left_profile_content')

    <div class="profile-card">

        <div class="row d-flex flex-column mt-2">
            <div class="col mb-4">
                <a href="{{ route('tickets') }}" class="btn btn-sm btn-primary">{{ __('messages.return') }}</a>
            </div>
            <div class="col border-bottom">
                <h4 class="h4 my-2">{{ __('messages.new_ticket') }} </h4>
            </div>
        </div>
        <div class="row  mt-2">
            <form action="{{ route('new.ticket.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row mt-2 ">
                    <div class="col">
                        <div class="mt-3">
                            <label for="category" class="form-label font-16">{{ __('messages.category_ticket') }}</label>
                            <select name="category" class="form-select" id="category">
                                <option value="">{{ __('messages.choose') }}</option>
                                @foreach( $categories as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col">
                        <div class="mt-3">
                            <label for="priority" class="form-label font-16">{{ __('messages.priority_ticket') }}</label>
                            <select name="priority" class="form-select" id="priority">
                                <option value="">{{ __('messages.choose') }}</option>
                                @foreach( $priorities as $priority )
                                    <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('priority')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="mt-3">
                        <label for="subject" class="form-label font-16">{{ __('messages.description') }}</label>
                        <input type="text" class="form-control"  id="subject" name="subject">
                    </div>
                    @error('subject')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col">
                    <div class="mt-3">
                        <label for=description" class="form-label font-16">{{ __('messages.description') }}</label>
                        <textarea class="form-control" rows="6" id="description" name="description"></textarea>
                    </div>
                    @error('description')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col">
                    <div class="mt-3">
                        <label for=description" class="form-label font-16">{{ __('messages.file') }}</label>
                        <input type="file" class="form-control"  id="file" name="file">
                    </div>
                    @error('file')
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

            </form>
        </div>

    </div>
@endsection



