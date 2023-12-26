<?php

namespace App\Http\Livewire\Front\Layout;

use App\Models\MainSlider;
use Livewire\Component;

class FrontMainSlider extends Component
{
    public function render()
    {
        return view('livewire.front.layout.front-main-slider')
        ->with('banners',MainSlider::select(['image_path','url'])
            ->where('status','1')->take(4)->get());
        // //select(['image_path','url'])->where('status','1')->get()
    }
}
