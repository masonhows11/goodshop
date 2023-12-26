@extends('front.profile.master_profile')
@section('page_title')
    {{ __('messages.products_compare') }}
@endsection
@section('left_profile_content')

    <div class="profile-card"><!-- start address box -->
        <p class="font-13">{{ __('messages.products_compare') }}</p>
        <livewire:front.compare.compare-products/>

    </div>


@endsection

