<?php

namespace App\Http\Livewire\Front\Layout;

use App\Models\AmazingOfferBanner;
use App\Models\AmazingSales;
use Livewire\Component;

class FrontAmazingOffer extends Component
{
    // this livewire controller for amazing banner &
    // amazing sale product from AmazingSales model

    public $banners;
    public $amazingSales;
    public function mount()
    {
        $this->banners = AmazingOfferBanner::select(['image_path','url'])
            ->where('status',1)
            ->take(4)
            ->get();
        $this->amazingSales = AmazingSales::with('product:id,title_persian,origin_price,thumbnail_image,slug')
            ->where('status',1)
            ->get();
    }

    public function render()
    {
        return view('livewire.front.layout.front-amazing-offer')
            ->with(['banners' => $this->banners,
                    'amazingSales' => $this->amazingSales]);
    }
}
