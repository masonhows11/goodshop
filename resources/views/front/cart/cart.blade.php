@extends( 'front.layouts.master_front')
@section( 'page_title')
        {{ __('messages.basket') }}
@endsection
@section( 'main_content')
    <div class="container-fluid">

        <div class="row shopping-cart-section">


         <livewire:front.cart.shopping-cart />

        </div>

    </div>
@endsection
