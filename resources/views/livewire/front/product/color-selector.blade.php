<div>
    <p class=""> {{ __('messages.select_color') }} : {{ $selectedColorName }}</p>
      <label class="select-color">
        <span class="color-shape" style="background-color:{{ $selectedColor->color_code }};"></span>
        <input type="radio" name="color" wire:click="radioClick({{ $selectedColor->color_id  }})" >
        <span class="color-name {{ $defaultColor == true ? 'active-select-color' : '' }}"
              wire:click="selectColor({{ $selectedColor->color_id }})" >{{ $selectedColor->color_name }}</span>
       </label>
    @if( $colors !== null )
        @foreach( $colors as $color)
                <label class="select-color">
                    <span class="color-shape" style="background-color:{{ $color->color_code }};"></span>
                    <input type="radio" name="color" wire:click="radioClick({{ $color->color_id  }})" >
                    <span class="color-name  {{ $changeColor == true ? 'active-select-color' : '' }}"
                       wire:click="selectColor({{ $color->color_id }})" >{{ $color->color_name }}</span>
                </label>
        @endforeach
    @else
    @endif
</div>
