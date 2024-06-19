<div>
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.product.comments.list',$product->title_persian) }}
    @endsection
    <div class="row product-section">
            <div class="card mb-1 h-75" style="">
                <div class="row">
                    <div class="col-md-3 d-flex justify-content-start  p-4">
                        @if( $product->thumbnail_image != null && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->thumbnail_image ) )
                            <img src="{{ asset('storage/'.$product->thumbnail_image) }}" style="height:350px" class="img-fluid  rounded" alt="product_image">
                        @else
                            <img src="{{ asset('dash/images/no-image-icon-23494.png') }}"  style="height:350px" class="img-fluid  rounded" alt="product_image">
                        @endif
                    </div>

                    <div class="col-md-8 d-flex justify-content-center align-items-center ">
                        <div class="card-body my-5">
                            <h5 class="card-title">{{ $product->title_persian }}</h5>
                            <p class="card-text">{!! $product->short_description !!}</p>
                            <p class="card-text">
                                <span class="text-muted"> تاریخ ایجاد : {{ jdate($product->created_at)->ago() }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="row comments-section overflow-auto">
        <div class="col bg-white">
            <table class="table table-bordered">
                <thead>
                <tr class="text-center">
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.user_id') }}</th>
                    <th>{{ __('messages.author') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.show') }}</th>
                    <th>{{ __('messages.confirm_status') }}</th>
                    <th>{{ __('messages.delete_model') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $comments as $comment)
                    <tr class="text-center">
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->user->id ? $comment->user->id : 0 }}</td>
                        <td>{{ $comment->user->name ? $comment->user->name :   __('messages.support_response') }}</td>
                        <td>{{ $comment->status == 0 ? __('messages.wait_for_confirmed') : __('messages.confirmed')  }}</td>
                        <td>
                            <a href="{{ route('admin.comment.show',['comment' => $comment->id]) }}"
                               class="btn btn-primary btn-sm">{{ __('messages.show_comment') }}</a></td>
                        <td>
                            <a href="javascript:void(0)" wire:click.prevent="approved({{ $comment->id }})"
                               class="btn {{ $comment->status == 0 ? 'btn-warning' : 'btn-success' }}  btn-sm">
                                {{ $comment->status == 0 ? __('messages.not_confirmed') : __('messages.confirmed') }}
                            </a>
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm"
                               wire:click.prevent="deleteConfirmation({{ $comment->id }})">
                                {{ __('messages.delete_model') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row bg-white  mt-4 d-flex justify-content-center">
        <div class="col-lg-2 col-md-2 py-2">
            {{ $comments->links() }}
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
