<div>
    @section('dash_page_title')
        {{ __('messages.show_comment') }}
    @endsection
    @section('breadcrumb')

    @endsection
        <div class="container-fluid product-single-comment-section">
            <div class="row  my-3">
                <div class="col-lg-3 col-md-3 col title-product">
                    <div class="alert bg-white text-center h3">
                        {{ __('messages.show_comment') }}
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-column my-2  comment-wrapper bg-white">

                <div class="col-lg-8 comment-body-section">
                    <div class="card  mt-4 mb-4 border border-2 border-secondary">
                        <div class="card-header d-flex align-items-center bg-secondary">
                            <p class="h5"> نویسنده نظر :  {{ $comment->user->name }}</p>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{!! $comment->body !!}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 my-4 comment-reply-section">
                    <form wire:submit.prevent="save">

                        <div class="mb-3">
                            <label for="answer" class="form-label">{{ __('messages.answer') }}</label>
                            <textarea class="form-control" wire:model.defer="body" id="answer" rows="3"></textarea>
                        </div>
                        @error('body')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="mb-3 mt-3 d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-success btn-sm">{{ __('messages.send') }}</button>
                            </div>
                            <div>
                                <a href="{{ route('admin.comments.index.product',['product'=>$comment->product_id]) }}" class="btn btn-primary btn-sm">لیست نظرات</a>
                            </div>
                        </div>
                    </form>
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
