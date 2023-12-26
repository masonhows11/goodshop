<div>
        <a href="{{ route('cart.check') }}" class="position-relative">
            <img src="{{ asset('front/images/cart.png') }}" alt="cart">
            <div class="count" >{{ $cartItemsCount ? $cartItemsCount : 0  }}</div>
        </a>

</div>
