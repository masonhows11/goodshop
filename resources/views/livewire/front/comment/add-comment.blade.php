<div>
    <div class="tab-pane comment-tab">
        <p class="m-3 font-14">امتیاز کاربران</p>
        <div class="row d-flex flex-column mx-2">
            <div class="col-md-6 mb-2 rating-average">
                <p>{{ __('messages.rate_average') }} {{ $rate_avg!= null ? number_format($rate_avg,1,'/') :  __('messages.you_give_the_first_rating_for_this_product') }}</p>
                <p>{{ __('messages.the_number_of_users_who_rated_this_product') }} {{ $total_rate != null ? $total_rate : __('messages.you_give_the_first_rating_for_this_product') }}</p>
            </div>

            @if( auth()->check() )
                @if( auth()->user()->isUserBuyProduct($product_id)->count() > 0)
                    <div class="col-md-6 mb-2 rating-start">
                        <div class="star-rating rising-star d-flex justify-content-end flex-row-reverse">
                            {{-- for stars is set yellow color --}}
                            @for( $i = 1; $i <= $rated_value ; $i++)
                                <input type="radio" id="star{{$i}}" name="rating" wire:click="addRate({{ $i }})"/>
                                <label for="star{{ $i }}" class="text-warning">{{ $i }}</label>
                            @endfor
                            {{-- for stars not set black color --}}
                            @for( $i = $rated_value; $i < 5 ; $i++)
                                <input type="radio" id="star{{$i+1}}" name="rating" wire:click="addRate({{ $i + 1 }})"/>
                                <label for="star{{ $i+1 }}" class="text-dark">{{ $i+1 }}</label>
                            @endfor
                        </div>
                    </div>
                @endif
            @else
                <div class="col-md-6 mb-2 rating-start">
                    <div class="star-rating rising-star d-flex justify-content-end flex-row-reverse">
                        {{-- for stars is set yellow color --}}
                        @for( $i = 1; $i <= $rate_avg ; $i++)
                            <input type="radio" id="star{{$i}}" wire:click="guest_add_Rate()" name="rating"/>
                            <label for="star{{ $i }}" class="text-warning">{{ $i }}</label>
                        @endfor
                        {{-- for stars not set black color --}}
                        @for( $i = $rate_avg; $i < 5 ; $i++)
                            <input type="radio" id="star{{$i+1}}" wire:click="guest_add_Rate()" name="rating"/>
                            <label for="star{{ $i+1 }}" class="text-dark">{{ $i+1 }}</label>
                        @endfor
                        {{--
                         <input type="radio" id="star4" name="rating" value="4"  wire:click="addRate(4)"/>
                         <label for="star4" class="" title="4 star"></label>
                         --}}
                    </div>
                </div>

            @endif

        </div>
        <div class="row mx-2">
            <!-- start rating result-->
            <div class="col-md-6 rating-result">
                <div class="d-flex justify-content-between mb-2">
                    <span class="font-12">کیفیت ساخت:</span>
                    <span class="font-12">خوب</span>
                </div>
                <div class="progress mb-3">
                    <div class="progress-bar bg-info" style="width:60%;"></div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="font-12">ارزش خرید به نسبت قیمت:</span>
                    <span class="font-12">عالی</span>
                </div>
                <div class="progress mb-3">
                    <div class="progress-bar bg-info" style="width:80%;"></div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="font-12">امکانات و قابلیت ها:</span>
                    <span class="font-12">خوب</span>
                </div>
                <div class="progress mb-3">
                    <div class="progress-bar bg-info" style="width:50%;"></div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="font-12">نوآوری :</span>
                    <span class="font-12">خوب</span>
                </div>
                <div class="progress mb-3">
                    <div class="progress-bar bg-info" style="width:75%;"></div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="font-12">طراحی و ظاهر :</span>
                    <span class="font-12">عالی</span>
                </div>
                <div class="progress mb-3">
                    <div class="progress-bar bg-info" style="width:90%;"></div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="font-12">سهولت استفاده :</span>
                    <span class="font-12">خوب</span>
                </div>
                <div class="progress mb-3">
                    <div class="progress-bar bg-info" style="width:80%;"></div>
                </div>
            </div>
            <!-- end ratig result-->

            <!-- start add comment box -->
            <div class="col-md-6 add-comment">
                <div class="row">
                    <p>شما هم درباره این کالا دیدگاه ثبت کنید</p>
                    <p>برای ثبت نظر، لازم است ابتدا وارد حساب کاربری خود شوید.
                        اگر این محصول را قبلا از خرید خوب خریده باشید، نظر شما به عنوان مالک محصول
                        ثبت خواهد شد.
                    </p>
                </div>
                @auth
                    <div class="row">
                        <form wire:submit.prevent="addComment">
                            <div class="mb-3">
                                <label for="comment_body" class="form-label">{{ __('messages.comment_text') }}</label>
                                <textarea class="form-control" wire:model="body" id="comment_body" rows="4"></textarea>
                            </div>
                            @error('body')
                            <div class="alert alert-danger mt-4 font-12">
                                {{ $message }}
                            </div>
                            @enderror

                            @if( session()->has('error'))
                                <div class="alert alert-danger mt-4 font-12">
                                    {{ session()->get('error') }}
                                </div>
                            @elseif( session()->has('success'))
                                <div class="alert alert-success mt-4 font-12">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary font-13 px-4 py-2 mt-3 ms-3">افزودن نظر
                                    جدید
                                </button>
                            </div>

                        </form>
                    </div>
                @else
                    <p>{{ __('messages.to_post_a_comment_you_must_first_log_in_to_your_account') }}</p>
                @endauth
            </div>
        </div>
        <!-- ens add comment box -->

        <div class="row mx-3">
            <div class="col-12">
                <p class="font-13 my-4"><span>{{ __('messages.comment_count') }}  ({{ $comments_count }})</span></p>


            @if( $comments !== null )
                <!-- start user comment box -->
                    @foreach($comments as $comment )
                        <div class="row border-bottom mb-4">
                            <!-- start comment info -->
                            <div class="col-lg-3 col-md-4 col-12">
                                <div class="comment-info">
                                    <p class="font-13 my-2"> @if( !empty($comment->user->name)) {{ $comment->user->name }} @else {{ __('messages.unknown') }} @endif  </p>
                                    <p class="font-12 text-muted my-3">{{ jalaliDate($comment->created_at) }}</p>
                                    <div class="star-box">
                                        <i class="fa fa-star font-12 ms-1 text-warning"></i>
                                        <i class="fa fa-star font-12 ms-1 text-warning"></i>
                                        <i class="fa fa-star font-12 ms-1 text-warning"></i>
                                        <i class="fa fa-star font-12 ms-1 text-warning"></i>
                                        <i class="fa fa-star font-12 ms-1 text-muted"></i>
                                    </div>
                                    <p class="font-12 text-muted border border-info rounded d-inline-block p-2">
                                        <i class="fa fa-thumbs-up font-13 text-info"></i> خرید این محصول
                                        را توصیه می‌کنم
                                    </p>
                                </div>
                            </div>
                            <!-- end comment info -->
                            <div
                                class="col-lg-9 col-md-8 col-12 @if ($comment->answers()->count() > 0 ) border-bottom @endif ">
                                <!-- start comment text -->
                                <p class="font-13 line-height">
                                    {{ $comment->body }}
                                </p>
                                <div class="row">
                                    <div class="col-md-4 col-6 ">
                                        <span class="font-13 text-info"> نقاط قوت </span>
                                        <ul class="ps-2 pt-0 positve-point">
                                            <li class="font-13  my-2">سبک</li>
                                            <li class="font-13  my-2"> صفحه نمایش عالی</li>
                                            <li class="font-13  my-2">سرعت پردازش بالا</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <span class="font-13 text-danger"> نقاط ضعف </span>
                                        <ul class="ps-2 pt-0 negative-point">
                                            <li class="font-13 my-2">قیمت زیاد</li>
                                            <li class="font-13  my-2"> باتری ضعیف</li>
                                        </ul>
                                    </div>
                                    <div class="col-12 mb-3 text-end">
                                        <span
                                            class="font-13 text-muted d-block mb-3">آیا این نظر برایتان مفید بود؟</span>
                                        <a href="#" class="font-13 text-muted ms-2 border p-1 rounded">بله
                                            (12) <i class="fa fa-thumbs-up text-info"></i></a>
                                        <span class="text-muted">|</span>
                                        <a href="#" class="font-13 text-muted border p-1 rounded">خیر
                                            (4) <i class="fa fa-thumbs-down text-danger"></i></a>
                                    </div>
                                </div>
                            </div> <!-- end comment text -->

                            <!-- answer comment -->
                            @foreach( $comment->answers()->get() as $answer )
                                <div class="row border-bottom mb-4 mt-4 d-flex justify-content-end">
                                    <!-- start comment info -->
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 col-12">
                                                <div class="comment-info">
                                                    <p class="font-13 my-2"> @if( !empty($answer->user->name)) {{ $answer->user->name }} @else {{ __('messages.unknown') }} @endif  </p>
                                                    <p class="font-12 text-muted my-3">{{ jalaliDate($answer->created_at) }}</p>
                                                    <div class="star-box">
                                                        <i class="fa fa-star font-12 ms-1 text-warning"></i>
                                                        <i class="fa fa-star font-12 ms-1 text-warning"></i>
                                                        <i class="fa fa-star font-12 ms-1 text-warning"></i>
                                                        <i class="fa fa-star font-12 ms-1 text-warning"></i>
                                                        <i class="fa fa-star font-12 ms-1 text-muted"></i>
                                                    </div>
                                                    <p class="font-12 text-muted border border-info rounded d-inline-block p-2">
                                                        <i class="fa fa-thumbs-up font-13 text-info"></i> خرید این محصول
                                                        را توصیه می‌کنم
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- end comment info -->
                                            <div class="col-lg-9 col-md-8 col-12"><!-- start comment text -->
                                                <p class="font-13 line-height">
                                                    {{ $answer->body }}
                                                </p>
                                                <div class="row">
                                                    <div class="col-12 mb-3 text-end">
                                                        <span class="font-13 text-muted d-block mb-3">آیا این نظر برایتان مفید بود؟</span>
                                                        <a href="#" class="font-13 text-muted ms-2 border p-1 rounded">بله
                                                            (12) <i class="fa fa-thumbs-up text-info"></i></a>
                                                        <span class="text-muted">|</span>
                                                        <a href="#" class="font-13 text-muted border p-1 rounded">خیر
                                                            (4) <i class="fa fa-thumbs-down text-danger"></i></a>
                                                    </div>
                                                </div>
                                            </div> <!-- end comment text -->
                                        </div>
                                    </div>
                                </div>  <!-- end user answer comment box -->
                            @endforeach
                        </div>  <!-- end user comment box -->

                    @endforeach
                @else
                    <div class="row border-bottom mb-4">
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="comment-info">
                                <p class="font-12 text-muted border border-info rounded d-inline-block p-2">
                                    <i class="fa fa-comment-alt font-13 text-info"></i>
                                    {{ __('messages.there_is_no_comment_for_this_product') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-lg-2 col-md-2 ">
                {{ $comments->links() }}
            </div>
        </div>
    </div>

</div>
{{--@push('custom_scripts')
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
        const alertToast = Swal.mixin({
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
            alertToast.fire({
                icon: type,
                title: message
            })
        })
        @if( session()->has('warning') )
        alertToast.fire({
            icon: 'warning',
            title: '{{ session()->get('warning') }}'
        })
        @elseif( session()->has('success'))
        alertToast.fire({
            icon: 'success',
            title: '{{ session()->get('success') }}'
        })
        @endif
    </script>
@endpush--}}
