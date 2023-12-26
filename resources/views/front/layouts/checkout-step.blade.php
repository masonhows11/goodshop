
<div class="col-12">
        <ul class="checkout-steps">
            <li class="is-completed">
                @php
                    $currentRoute = 'check.address';
                @endphp
                @if( $currentRoute == request()->route()->getName() )
                    <a href="#" class="checkout-steps-active  active-link-shopping">اطلاعات ارسال</a>
                @else
                    <a href="#" class="checkout-steps-active  active-link">اطلاعات ارسال</a>
                @endif
            </li>
            <li class="is-completed">
                <a href="#" class="checkout-steps-item  active-link">پرداخت</a>
            </li>
            <li class="is-active">
                <a href="#" class="checkout-steps-item  active-link">اتمام خرید و ارسال</a>
            </li>
        </ul>
</div>
