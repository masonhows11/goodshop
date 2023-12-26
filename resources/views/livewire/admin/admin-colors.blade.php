<div>
    @section('dash_page_title')
        {{ __('messages.color_management') }}
    @endsection
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.create.color') }}
    @endsection
    <div class="container-fluid admin-colors-section">
        <div class="row bg-white rounded create-color-form">
            <form wire:submit.prevent="save">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="mt-3 mb-3">
                                <label for="title_persian" class="form-label">{{ __('messages.name_persian') }}</label>
                                <input type="text" class="form-control" id="title_persian"
                                       wire:model.defer="title_persian">
                                @error('title_persian')
                                <div class="alert alert-danger mt-3">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mt-3 mb-3">
                                <label for="title_english" class="form-label">{{ __('messages.name_english') }}</label>
                                <input type="text" class="form-control" id="title_english"
                                       wire:model.defer="title_english">
                                @error('title_english')
                                <div class="alert alert-danger mt-3">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mt-3 mt-3">
                                <label for="color_code" class="form-label">{{ __('messages.color_code') }}</label>
                                <input wire:model.defer="color_code" id="color_code" class="form-control" data-jscolor="{previewPosition:
                                'right',closeButton: true,
                                closeText: 'OK'}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <button type="submit" id="add_attribute" class="btn btn-success btn-sm">{{ __('messages.save') }}</button>
                </div>
            </form>
        </div>
        <div class="row mt-4 d-flex justify-content-center search-color-section">
            <div class="col">
                <div class="mb-3 mt-3">
                    <input wire:model.debounce.500ms="search" placeholder="{{ __('messages.search') }}" type="text" class="form-control" id="search">
                </div>
            </div>
        </div>
        <div class="row mt-5 bg-white">
            <div class="my-5 list-colors">
                    <table class="table table-striped">
                        <thead class="border-bottom-3 border-top-3">
                        <tr class="text-center">
                            <th>{{ __('messages.id') }}</th>
                            <th>{{ __('messages.name_persian') }}</th>
                            <th>{{ __('messages.name_english') }}</th>
                            <th>{{ __('messages.color_code') }}</th>
                            <th>{{ __('messages.display_color') }}</th>
                            <th>{{ __('messages.edit_model') }}</th>
                            <th>{{ __('messages.delete_model') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($colors as $color)
                            <tr class="text-center">
                                <td>{{ $color->id }}</td>
                                <td>{{ $color->title_persian }}</td>
                                <td>{{ $color->title_english }}</td>
                                <td>{{ $color->code }}</td>
                                <td><span class="badge badge-circle" style=" background-color: {{ $color->code }}"></span></td>
                                <td><a class="mt-3" href="javascript:void(0)" wire:click.edit="edit({{$color->id}})"><i class="mt-3 fa fa-edit"></i></a></td>
                                <td><a class="mt-3" href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $color->id }})"><i class="mt-3 fa fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-2 col-md-2">
                {{ $colors->links() }}
            </div>
        </div>
    </div>
</div>

@push('dash_custom_script')
    <script type="text/javascript" src="{{ asset('dash/plugins/jscolor/jscolor.js') }}">

    </script>
    <script type="text/javascript">
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'آیا مطمئن هستید این ایتم حذف شود؟',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف کن!',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteConfirmed')
                }
            });
        })
    </script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        window.addEventListener('show-result', ({detail: {type, message}}) => {
            Toast.fire({
                icon: type,
                title: message
            })
        })
        @if(session()->has('warning'))
        Toast.fire({
            icon: 'warning',
            title: '{{ session()->get('warning') }}'
        })
        @elseif(session()->has('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session()->get('success') }}'
        })
        @endif
    </script>
@endpush
