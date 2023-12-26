@extends('dash.include.master_dash')
@section('dash_page_title')
    {{ __('messages.attachment_files') }}
@endsection
@push('dash_custom_style')
    <link rel="stylesheet" href="{{ asset('dash/plugins/jalalidatepicker/dist/css/persian-datepicker.min.css') }}">
@endpush
@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('admin.delivery.create') }}--}}
@endsection
@section('dash_main_content')

    <div class="container-fluid">


        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3>{{ __('messages.new_attachment_file') }} </h3>
                </div>
            </div>
        </div>
        <div class="row my-4 bg-white">
            <div class="col-lg-4 col-md-4 col my-2">
                <a href="{{ route('admin.email.notices.index') }}" class="btn btn-sm btn-primary">{{ __('messages.notices_list') }}</a>
                <a href="{{ route('admin.email.notice.file.index',['id' => $mail_id ]) }}" class="btn btn-sm btn-primary">{{ __('messages.attachment_file_list') }}</a>
            </div>
        </div>

        <form action="{{ route('admin.email.notice.file.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row create-email-notice-file my-4 bg-white">

                <input type="hidden" name="mail" value="{{ $mail_id }}">
                <div class="col mt-2">
                    <div class="">
                        <label for="file" class="form-label">{{ __('messages.file') }}</label>
                        <input type="file" id="file"
                               class="form-control @error('file') is-invalid @enderror form-control-lg"
                               name="file">
                    </div>
                    @error('file')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col mt-2">
                    <div class="">
                        <label for="status" class="form-label">{{ __('messages.status') }}</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">{{ __('messages.choose') }}</option>
                            <option value="0">{{__('messages.deactivate')}}</option>
                            <option value="1">{{ __('messages.active') }}</option>
                        </select>
                    </div>
                    @error('status')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>




                <div class="mb-2 mt-2">
                    <div>
                        <input type="submit" class="btn btn-success mt-4 " value="{{ __('messages.save') }}">
                    </div>
                </div>


            </div>



        </form>


    </div>

@endsection
@push('dash_custom_script')
  <script type="text/javascript" src="{{ asset('dash/plugins/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('dash/plugins/jalalidatepicker/assets/persian-date.min.js')  }}"></script>
    <script type="text/javascript"
            src="{{ asset('dash/plugins/jalalidatepicker/dist/js/persian-datepicker.min.js')  }}"></script>

    <script>
       CKEDITOR.replace('email-body', {
            language: 'fa',
            removePlugins: 'image',
        });

        $(document).ready(function () {
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at',
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            })
        })

        $(document).ready(function () {
            @if(session('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                newWindow: true,
                close: false,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
            }).showToast();
            @elseif(session('error'))
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
            }).showToast();
            @endif
        })
    </script>
@endpush
