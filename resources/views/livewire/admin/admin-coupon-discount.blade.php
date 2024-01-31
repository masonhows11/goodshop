<div>
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.coupons.index') }}
    @endsection

    <div class="row d-flex justify-content-start my-4 bg-white">
        <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
            <div class="alert my-4">
                <h3> {{ __('messages.coupon_discount_list') }}</h3>
            </div>
        </div>
    </div>
    <div class="row my-4 bg-white">
        <div class="col-lg-4 col-md-4 col my-2">
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-sm btn-primary">{{ __('messages.new_coupon') }}</a>
        </div>
    </div>
    <div class="row  common-discount-list bg-white overflow-auto">
        <div class=" my-5">
            <table class="table table-striped">
                <thead class="border-bottom-3 border-top-3">
                <tr class="text-center">
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.coupon_code') }}</th>
                    <th>{{ __('messages.coupon_amount') }}</th>
                    <th>{{ __('messages.discount_ceiling') }}</th>
                    <td>{{ __('messages.coupon_type') }}</td>
                    <th>{{ __('messages.coupon_amount_type') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.start_date') }}</th>
                    <th>{{ __('messages.end_date') }}</th>
                    <th>{{ __('messages.operation') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($coupons as $coupon)
                    <tr class="text-center">
                        <td>{{ $coupon->id }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td>{{$coupon->amount_type == 0 ? $coupon->amount . '%' : number_format($coupon->amount) }}</td>
                        <td>{{ $coupon->discount_ceiling != null ? number_format($coupon->discount_ceiling) : '_'   }}</td>
                        <td>{{ $coupon->type == 0 ? __('messages.public_coupon') : __('messages.private_coupon')}}</td>
                        <td>{{ $coupon->amount_type == 0 ? __('messages.percentage_type') : __('messages.numeric_type') }}</td>
                        <td><a href="javascript:void(0)"  wire:click.prevent="changeStatus({{ $coupon->id }})"
                                class="btn btn-sm {{ $coupon->status  == 1 ? 'btn-success' : 'btn-danger' }}">
                                {{ $coupon->status ==  1 ? __('messages.active') : __('messages.deactivate') }}</a></td>
                        <td>{{  jdate($coupon->start_date)->format('%B %d، %Y')  }}</td>
                        <td>{{ jdate($coupon->end_date)->format('%B %d، %Y') }}</td>
                        <td>
                            <a href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $coupon->id }})" class="" ><i class="fa fa-trash"></i></a>
                            <a href="{{ route('admin.coupons.edit',$coupon->id) }}" class="ms-2"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row d-flex justify-content-center list-stock-paginate">
        <div class="col-lg-2 col-md-2 ">
            {{ $coupons->links() }}
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
        window.addEventListener('show-result', ({ detail: {type, message } }) => {
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
