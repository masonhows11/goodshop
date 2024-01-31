<div>
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.amazing.sale.index') }}
    @endsection

    <div class="row d-flex justify-content-start my-4 bg-white">
        <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
            <div class="alert my-4">
                <h3> {{ __('messages.amazing_sales_list') }}</h3>
            </div>
        </div>
    </div>
    <div class="row my-4 bg-white">
        <div class="col-lg-4 col-md-4 col my-2">
            <a href="{{ route('admin.amazing.sale.create') }}" class="btn btn-sm btn-primary">{{ __('messages.new_amazing_sales_list') }}</a>
        </div>
    </div>
    <div class="row  common-discount-list bg-white overflow-auto">
        <div class="my-5">
            <table class="table table-striped">
                <thead class="border-bottom-3 border-top-3">
                <tr class="text-center">
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.product_name') }}</th>
                    <th>{{ __('messages.percentage_discount') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.start_date') }}</th>
                    <th>{{ __('messages.end_date') }}</th>
                    <th>{{ __('messages.operation') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($amazingSales as $sale)
                    <tr class="text-center">
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->product->title_persian }}</td>
                        <td>{{ $sale->percentage }} %</td>
                        <td><a href="javascript:void(0)"  wire:click.prevent="changeStatus({{ $sale->id }})"
                               class="btn btn-sm {{ $sale->status  == 1 ? 'btn-success' : 'btn-danger' }}">
                                {{ $sale->status ==  1 ? __('messages.active') : __('messages.deactivate') }}</a></td>
                        <td>{{  jdate($sale->start_date)->format('%B %d، %Y')  }}</td>
                        <td>{{ jdate($sale->end_date)->format('%B %d، %Y') }}</td>
                        <td>
                            <a href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $sale->id }})" class="" ><i class="fa fa-trash"></i></a>
                            <a href="{{ route('admin.amazing.sale.edit',$sale->id) }}" class="ms-2"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row d-flex justify-content-center list-stock-paginate">
        <div class="col-lg-2 col-md-2 ">
            {{ $amazingSales->links() }}
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
