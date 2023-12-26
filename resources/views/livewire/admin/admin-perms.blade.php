<div>
    @section('dash_page_title')
        {{ __('messages.manage_perms') }}
    @endsection
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.perms') }}
    @endsection
    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3>{{ __('messages.manage_perms') }}</h3>
                </div>
            </div>
        </div>

        <div class="row my-4 bg-white admin-create-new-perm">
            <div class="col-lg-5 mb-3 mt-3">
                <form wire:submit.prevent="storePerm">
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">نام مجوز :</label>
                        <input type="text" wire:model.defer="name" class="form-control" id="name">
                    </div>
                    @error('name')
                    <div class="alert alert-danger my-2">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">ذخیره</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row bg-white mb-4 admin-list-roles">
            <div class="my-5 list-content">

                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>شناسه</th>
                        <th>نام نقش</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($perms)
                        @foreach($perms as $perm)
                            <tr class="text-center">
                                <td>{{ $perm->id }}</td>
                                <td>{{ $perm->name }}</td>
                                <td class="mb-3">
                                    <a href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $perm->id }})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                <td class="mb-3">
                                    <a href="javascript:void(0)" wire:click="editPerm({{ $perm->id }})">
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

    </script>
@endpush
