<div>
    @section('dash_page_title')
        مدیریت برند ها
    @endsection
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.brands') }}
    @endsection
    <div class="container-fluid">


        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3> {{ __('messages.brands') }}</h3>
                </div>
            </div>
        </div>

        <div class="row my-4 bg-white">
            <div class="col-lg-4 col-md-4 col my-2">
                <a href="{{route('admin.brand.create')}}" class="btn btn-primary">{{ __('messages.new_brand') }}</a>
            </div>
        </div>



        <div class="row d-flex justify-content-center search-brand-section">
            <div class="col">
                <div class="mb-3 mt-3">
                    <input wire:model.debounce.500ms="search" placeholder="{{ __('messages.search') }}" type="text" class="form-control" id="search">
                </div>
            </div>
        </div>

        <div class="row brand-list bg-white">
            <div class="my-5">
                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.image') }}</th>
                        <th>{{ __('messages.name_persian') }}</th>
                        <th>{{ __('messages.name_english') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.edit_model') }}</th>
                        <th>{{ __('messages.delete_model') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $brand)
                        <tr class="text-center">
                            <td>{{ $brand->id }}</td>
                            <td><img width="120" height="120" src="{{ $brand->logo_path ? asset('storage/images/'.$brand->logo_path) : asset('dash/images/no-image-icon-23494.png') }}" alt=""></td>
                            <td>{{ $brand->title_persian }}</td>
                            <td>{{ $brand->title_english }}</td>
                            <td><a href="javascript:void(0)" wire:click.prevent="active({{ $brand->id }})" class="btn {{ $brand->is_active  === 1  ? 'btn-success' : 'btn-danger'}}  btn-sm">{{ $brand->is_active === 1  ? __('messages.active') : __('messages.deactivate')}}</a></td>
                            <td><a href="{{ route('admin.brand.edit',['id'=>$brand->id]) }}"><i class="fa fa-edit"></i></a></td>
                            <td><a href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{$brand->id}})"><i class="fa fa-trash" id="delete_item"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="row d-flex justify-content-center bg-white my-4">
            <div class="col-lg-2 col-md-2 my-2 pt-2 pb-2">
                {{ $brands->links() }}
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
