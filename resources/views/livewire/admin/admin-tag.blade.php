<div>
    @section('dash_page_title')
      {{ __('messages.tags_management') }}
    @endsection
    @section('breadcrumb')
      {{ Breadcrumbs::render('admin.tag.index') }}
    @endsection
    <div class="container-fluid">
                <form wire:submit.prevent="store" class="bg-white">
                    <div class="row  admin-create-new-tag bg-white">
                            <div class="col-sm-6 mb-3 mt-3">
                                <label for="title_persian" class="form-label">نام تگ ( فارسی )</label>
                                <input type="text" wire:model.defer="title_persian"
                                       class="form-control"
                                       id="title_persian">
                                @error('title_persian')
                                <div class="alert alert-danger my-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3 mt-3">
                                <label for="title_english" class="form-label">نام تگ ( انگلیسی )</label>
                                <input type="text" wire:model.defer="title_english"
                                       class="form-control"
                                       id="title_english">

                                @error('title_english')
                                <div class="alert alert-danger my-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                    </div>
                    <div class="row bg-white">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">ذخیره</button>
                            <a href="javascript:void(0)" wire:click.prevent="newTag()" class="btn btn-secondary">{{ __('messages.new_tag') }}</a>
                        </div>
                    </div>
                </form>
        <div class="row mt-2">
            <div class="col bg-white rounded-3 admin-tag-list">
                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.name_persian') }}</th>
                        <th>{{ __('messages.name_english') }}</th>
                        <th>{{ __('messages.slug') }}</th>
                        <th>{{ __('messages.edit_model') }}</th>
                        <th>{{ __('messages.delete_model') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($tags)
                        @foreach($tags as $tag)
                            <tr class="text-center">
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->title_persian }}</td>
                                <td>{{ $tag->title_english }}</td>
                                <td>{{ $tag->slug }}</td>
                                <td class="mb-3">
                                    <a href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $tag->id }})" class="btn btn-sm mb-3">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                <td class="mb-3">
                                    <a href="javascript:void(0)" wire:click.prevent="editTag({{ $tag->id }})" class="btn btn-sm mb-3">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('dash_custom_script')
    <script type="text/javascript">
        window.addEventListener('show-delete-confirmation',event => {
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
