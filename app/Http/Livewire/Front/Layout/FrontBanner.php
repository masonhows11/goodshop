<?php

namespace App\Http\Livewire\Front\Layout;

use App\Models\bottomTwoBanner;
use Livewire\Component;

class FrontBanner extends Component
{
    public function render()
    {
        return view('livewire.front.layout.front-banner')
            ->with(['banners'=> bottomTwoBanner::select(['image_path','url'])
                ->where('status',1)->take(2)->get()]);
    }
}
