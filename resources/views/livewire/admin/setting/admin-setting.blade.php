<div>
    @section('dash_page_title')
        {{ __('messages.setting_site') }}
    @endsection
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.setting.index') }}
    @endsection
    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3> {{ __('messages.setting_site') }}</h3>
                </div>
            </div>
        </div>



        <div class="row  setting-list bg-white">
            <div class=" my-5">
                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.title') }}</th>
                        <th>{{ __('messages.description') }}</th>
                        <th>{{ __('messages.keywords') }}</th>
                        <th>{{ __('messages.logo') }}</th>
                        <th>{{ __('messages.icon') }}</th>
                        <th>{{ __('messages.operation') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($settings as $setting)
                        <tr class="text-center">
                            <td>
                               <div  class="mt-3"> {{ $setting->id }}</div>
                            </td>
                            <td>
                                <div  class="mt-3">{{ $setting->title }}</div>
                            </td>
                            <td>
                                <div class="mt-3">{{ $setting->description }}</div>
                            </td>
                            <td>
                                <div class="mt-3">{{ $setting->keywords }}</div>
                            </td>
                            <td>
                                <img class="img-thumbnail" width="100" height="100"
                                     src="{{ $setting->logo ? asset('storage'.$setting->logo) : asset('dash/images/no-image-icon-23494.png') }}"
                                     alt="">
                            </td>
                            <td>
                                <img class="img-thumbnail" width="100" height="100"
                                     src="{{ $setting->icon ? asset('storage'.$setting->icon) : asset('dash/images/no-image-icon-23494.png') }}"
                                     alt="">
                            </td>
                            <td>
                                <a class="mt-3" href="{{ route('admin.setting.edit',['setting' => $setting->id]) }}">
                                    <i class="mt-3 fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row d-flex justify-content-center list-stock-paginate">
            <div class="col-lg-2 col-md-2 ">
                {{ $settings->links() }}
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

