<div>
    <p class=""> انتخاب رنگ : {{ $selectedColorName }}</p>
    @if( $colors !== null )
        @foreach( $colors as $color)
          @if( $color->default == 1)
                <label class="select-color">
                    <span class="color-shape" style="background-color:{{ $color->color_code }};"></span>
                    <input type="radio" name="color" wire:click="radioClick({{ $color->color_id  }})" >
                    <span class="color-name  {{ $defaultColor == true ? 'active-select-color' : '' }}"
                       wire:click="selectColor({{ $color->color_id }})" >{{ $color->color_name }}</span>
                </label>
      @else
                <label class="select-color">
                    <span class="color-shape" style="background-color:{{ $color->color_code }};"></span>
                    <input type="radio" name="color" wire:click="radioClick({{ $color->color_id  }})">
                    <span class="color-name" wire:click="selectColor({{ $color->color_id }})">{{ $color->color_name }}</span>
                </label>
            @endif
        @endforeach
    @else
    @endif
</div>
