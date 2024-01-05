<div>
    @if( $warranties->count() !== 0)
        <span>{{ __('messages.warranty') }} :</span>
        @foreach( $warranties as $warranty)
            <div class="form-check">
                <input class="form-check-input form-control-md"
                       wire:click="selectWarranty({{ $warranty->id }})"
                       type="radio" name="warranty-name"  id="warranty-selector  + {{ $warranty->id }}">
                <label class="form-check-label"  for="warranty-selector  + {{ $warranty->id }}">{{ $warranty->guarantee_name }}</label>
            </div>
        @endforeach
    @else
        <div class="product-seller-row">
            <span>{{ __('messages.warranty') }} :</span>
            <span>{{ __('messages.no_warranty') }}</span>
        </div>
    @endif
</div>
