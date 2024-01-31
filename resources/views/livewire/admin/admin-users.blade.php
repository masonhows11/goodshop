<div>
    @section('dash_page_title')
        مدیریت کاربران
    @endsection
        @section('breadcrumb')
            {{ Breadcrumbs::render('admin.users') }}
        @endsection
    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3> {{ __('messages.users_management') }}</h3>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center search-category-section">
            <div class="col">
                <div class="mb-3 mt-3">
                    <input wire:model.debounce.500ms="search" placeholder="{{ __('messages.search') }}" type="text" class="form-control" id="search">
                </div>
            </div>
        </div>

        <div class="row users-management bg-white overflow-auto">
            <div class="my-5">
                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <th>شناسه</th>
                        <th>نام کاربری</th>
                        <th>حذف</th>
                        <th>وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($users)
                        @foreach($users as $user)

                            <tr class="text-center">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                @if($user->hasRole('admin'))
                                @else
                                    <td class="mb-3">
                                        <a href="javascript:void(0)"
                                           class="btn btn-sm btn-danger"
                                           wire:click.prevent="deleteConfirmation({{ $user->id }})">
                                            {{ __('messages.delete_model') }}
                                        </a>
                                    </td>
                                    <td class="mb-3">
                                        <a href="#" wire:click.prevent="activeUser({{ $user->id }})"
                                           class="btn
                                        {{ $user->activate == 0 ?   'btn-danger' : 'btn-success' }} btn-sm mb-3">
                                            {{ $user->activate == 0 ? __('messages.deactivate') : __('messages.active') }}
                                        </a>
                                    </td>
                                @endif
                            </tr>

                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row d-flex justify-content-center bg-white my-4 ">
            <div class="col-lg-4 col-md-4 my-2 pt-2 pb-2">
                {{ $users->links() }}
            </div>
        </div>

    </div>
</div>
@push('custom_script')
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
