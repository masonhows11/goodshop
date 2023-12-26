<div>
    @section('dash_page_title')
        مدیریت کالاها
    @endsection
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.product.index') }}
    @endsection
    <div class="container-fluid">

        <div class="row add-product-section ">
            <div class="col-lg-11 col-md-2 col-sm-2 my-4">
                <a href="{{ route('admin.product.create.basic') }}" class="btn btn-primary">{{ __('messages.new_product') }}</a>
            </div>
        </div>

        <div class="row mt-5 search-product-section">
            <div class="col-lg-11 col-md-2 cols-sm-2">
                <h3>{{ __('messages.search_product') }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
               <div class="row">
                   <div class="col">
                       <div class="mb-3">
                           <label for="title_search" class="form-label">{{ __('messages.title') }}</label>
                           <input type="text" class="form-control" wire:model.debounce.500ms="search" id="title_search" >
                       </div>
                   </div>
                   <div class="col">
                       <div class="mb-3">
                           <label for="orderBy_filter" class="form-label">{{ __('messages.orderBy') }}</label>
                           <select class="form-control"  wire:model.debounce.500ms="orderBy" id="orderBy_filter">
                               <option value="id">شناسه</option>
                               <option value="title_persian">عنوان (فارسی)</option>
                               <option value="title_english">عنوان (انگلیسی)</option>
                               <option value="created_at">تاریخ ایجاد</option>
                           </select>
                       </div>
                   </div>
                   <div class="col">
                       <div class="mb-3">
                           <label for="orderAsc_filter" class="form-label">{{ __('messages.orderBy') }}</label>
                           <select class="form-control"  wire:model.debounce.500ms="orderAsc" id="orderAsc_filter">
                               <option>{{ __('messages.choose') }}</option>
                               <option value="ASC">صعودی</option>
                               <option value="DESC">نزولی</option>
                           </select>
                       </div>
                   </div>
                   <div class="col">
                       <div class="mb-3">
                           <label for="paginate_filter" class="form-label">{{ __('messages.paginate') }}</label>
                           <select class="form-control" wire:model.debounce.500ms="paginate" id="paginate_filter">
                               <option value="5">5</option>
                               <option value="10">10</option>
                               <option value="15">15</option>
                               <option value="20">20</option>
                           </select>
                       </div>
                   </div>

               </div>
            </div>
        </div>
        <div class="row mt-5 result-search-product list-products">
            <div class="col">
                <table class="table table-bordered border-2 rounded-3 bg-white">
                    <thead>
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.image') }}</th>
                        <th>{{ __('messages.name_persian') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.product_price') }}</th>
                        <th>{{ __('messages.product_guarantee') }}</th>
                        <th>{{ __('messages.product_meta') }}</th>
                        <th>{{ __('messages.product_images') }}</th>
                        <th>{{ __('messages.product_colors') }}</th>
                        <th>{{ __('messages.product_tags') }}</th>
                        <th>{{ __('messages.edit_model') }}</th>
                        <th>{{ __('messages.delete_model')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $products as $product)
                        <tr class="text-center">
                            <td>{{ $product->id }}</td>
                            <td>
                                @if( $product->thumbnail_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->thumbnail_image ) )
                                <img class="img-thumbnail" width="100" height="100"
                                     src="{{ $product->thumbnail_image ? asset('storage/'.$product->thumbnail_image)
                                     : asset('dash/images/no-image-icon-23494.png') }}" alt="product_image">
                                @else
                                    <img class="img-thumbnail" width="100" height="100"
                                         src="{{ asset('dash/images/no-image-icon-23494.png') }}" alt="product_image">
                                @endif
                            </td>
                            <td>
                                <div class="mt-3">{{ Str::limit($product->title_persian,50)  }}</div>
                            </td>
                            <td>
                                <a href="javascript:void(0)" wire:click.prevent="changeState({{ $product->id }})"
                                   class="btn btn-sm {{ $product->status == 1 ? 'btn-success': 'btn-danger' }}">
                                    {{ $product->status == 1 ? __('messages.published')  : __('messages.unpublished') }}
                                </a>
                            </td>
                            <td>
                               <p class="mt-2">
                                   {{ priceFormat($product->origin_price) }} {{__('messages.toman')}}
                               </p>
                            </td>
                            <td>
                                <a href="{{ route('admin.product.guarantee.index',['product' => $product->id ]) }}"><i class="fa fa-shield-alt mt-3"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('admin.product.create.meta',['product' => $product->id ]) }}"><i
                                        class="fa fa-list mt-3"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('admin.product.create.images',['product' => $product->id ]) }}"><i
                                        class="fa fa-images mt-3"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('admin.product.create.colors',['product' => $product->id ]) }}"><i
                                        class="fa fa-paint-brush mt-3"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('admin.product.create.tags',['product' => $product->id ]) }}"><i
                                        class="fa fa-tags mt-3"></i></a>
                            </td>
                            <td><a class="mt-3"
                                   href="{{ route('admin.product.edit.basic',['product'=>$product->id]) }}"><i
                                        class="mt-3 fa fa-edit"></i></a></td>
                            <td><a class="mt-3" href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $product->id }})">
                                    <i class="mt-3 fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
           <div class="col-lg-2">
               {{ $products->links() }}
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
