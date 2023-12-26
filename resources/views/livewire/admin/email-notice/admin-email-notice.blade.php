<div>
    <div class="container-fluid">


        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3>{{ __('messages.email_notification') }}</h3>
                </div>
            </div>
        </div>

        <div class="row my-4 bg-white">
            <div class="col-lg-4 col-md-4 col my-2">
                <a href="{{ route('admin.email.notices.create') }}" class="btn btn-sm btn-primary">{{ __('messages.new_email_notice') }}</a>
            </div>
        </div>

        <div class="row  email-notice-list bg-white mb-4" style="height: 320px">
            <div class="my-5">

                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.title') }}</th>
                        <th>{{ __('messages.description') }}</th>
                        <th>{{ __('messages.notice_send_date') }}</th>
                        <th>{{ __('messages.notice_send_time') }}</th>
                        <th>{{ __('messages.attachment_files') }}</th>
                        <th>{{ __('messages.send_message') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.operation') }}</th>

                    </tr>
                    </thead>
                    <tbody>
                   @foreach( $notices as $notice)
                        <tr class="text-center">
                            <td>{{ $notice->id }}</td>
                            <td>{{ $notice->subject }}</td>
                            <td>{!! Str::limit($notice->body,60) !!}</td>
                            <td>{{ customJalaliDate($notice->published_at)  }}</td>
                            <td>{{ customJalaliDateTime($notice->published_at) }}</td>
                            <td><a href="{{ route('admin.email.notice.file.index',['id' => $notice->id]) }}" class="btn btn-sm btn-secondary">{{ __('messages.attachment_files') }}</a></td>
                            <td><a href="{{ route('admin.notices.send.mail',$notice->id) }}" class="btn btn-sm btn-primary">{{ __('messages.send_message') }}</a></td>
                            <td>
                                <a href="javascript:void(0)" wire:click.prevent="status({{ $notice->id }})"
                                   class="btn {{ $notice->status == 0 ? 'btn-warning' : 'btn-success' }}  btn-sm">
                                    {{ $notice->status == 0 ? __('messages.deactivate') : __('messages.active') }}
                                </a>
                            </td>
                            <td>
                              <div class="mt-2">
                                  <a href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $notice->id }})" class="" ><i class="fa fa-trash"></i></a>
                                  <a href="{{ route('admin.email.notices.edit',$notice->id) }}" class="ms-2"><i class="fa fa-edit"></i></a>
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
               {{ $notices->links() }}
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
