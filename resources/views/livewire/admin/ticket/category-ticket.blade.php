<div>

    <div class="row d-flex justify-content-start my-4 bg-white">
        <div class="col-lg-4 col-md-4 col  my-5  border-bottom">
            <div class="alert my-4">
                <h3>{{ __('messages.category_tickets') }} </h3>
            </div>
        </div>
    </div>



    <div class="row  delivery-list bg-white">
        <div class="col-lg-4 col-md-4 col my-4">
            <a href="{{ route('admin.category.ticket.create') }}" class="btn btn-primary">{{ __('messages.new_category_ticket') }}</a>
        </div>
        <div class="my-5">

            <table class="table table-striped">
                <thead class="border-bottom-3 border-top-3">
                <tr class="text-center">
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.operation') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $categories as $category)
                    <tr class="text-center">
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="javascript:void(0)" wire:click.prevent="status({{ $category->id }})"
                               class="btn {{ $category->status == 0 ? 'btn-danger' : 'btn-success' }}  btn-sm">
                                {{ $category->status == 0 ? __('messages.deactivate') : __('messages.active') }}
                            </a>
                        </td>
                        <td>
                            <a href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $category->id }})" class="" ><i class="fa fa-trash"></i></a>
                            <a href="{{ route('admin.category.ticket.edit',$category->id) }}" class="ms-2"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-lg-2 col-md-2 ">
            {{ $categories->links() }}
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
        @if( session()->has('warning') )
        Toast.fire({
            icon: 'warning',
            title: '{{ session()->get('warning') }}'
        })
        @elseif( session()->has('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session()->get('success') }}'
        })
        @endif
    </script>
@endpush
