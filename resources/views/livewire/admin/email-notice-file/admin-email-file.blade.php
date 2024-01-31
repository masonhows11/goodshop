<div>
    <div class="container-fluid">


        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3>{{ __('messages.attachment_files') }} / {{ $mail->subject }}</h3>
                </div>
            </div>
        </div>

        <div class="row my-4 bg-white">
            <div class="col-lg-4 col-md-4 col my-2">
                <a href="{{ route('admin.email.notices.index') }}" class="btn btn-sm btn-primary">{{ __('messages.notices_list') }}</a>
                <a href="{{ route('admin.email.notice.file.create',['mail_id' => $mail->id]) }}" class="btn btn-sm btn-primary">{{ __('messages.new_attachment_file') }}</a>
            </div>
        </div>

        <div class="row  email-notice-list bg-white mb-4 overflow-auto" style="height: 320px">
            <div class="my-5">

                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.email_notice') }}</th>
                        <th>{{ __('messages.file_size') }}</th>
                        <th>{{ __('messages.file_type') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.operation') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                   @foreach( $files as $file )
                        <tr class="text-center">
                            <td>{{ $file->id }}</td>
                            <td>{{ $file->email->subject }}</td>
                            <td><div class="d-flex flex-row justify-content-center">
                                    <div class="me-3">{{ __('messages.KB') }}</div>
                                    <div>{{ $file->file_size }}</div>
                                </div>
                            </td>
                            <td>{{ $file->file_type }}</td>
                            <td>
                                <a href="javascript:void(0)" wire:click.prevent="status({{ $file->id }})"
                                   class="btn {{ $file->status == 0 ? 'btn-warning' : 'btn-success' }}  btn-sm">
                                    {{ $file->status == 0 ? __('messages.deactivate') : __('messages.active') }}
                                </a>
                            </td>
                            <td>
                                <div class="mt-2">
                                    <a href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $file->id }})" class="" ><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="row d-flex justify-content-center bg-white">
            <div class="col-lg-2 col-md-2 my-3 py-3">
                {{ $files->links() }}
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

