<?php

namespace App\Http\Livewire\Front\Layout;

use Livewire\Component;
use App\Models\TopBanner;

class FrontTopAdvertising extends Component
{
    public function render()
    {
        return view('livewire.front.layout.front-top-advertising')
        ->with(['banner' => TopBanner::select(['image_path','url'])
        ->where('status','1')->first()]);
    }
}
