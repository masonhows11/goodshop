<?php

namespace App\Http\Livewire\Front\Layout;

use App\Models\Brand;
use Livewire\Component;

class FrontBrandsSlider extends Component
{
    public function render()
    {
        return view('livewire.front.layout.front-brands-slider')
            ->with(['brands' => Brand::select(['id','logo_path','title_persian'])
                ->where('is_active',1)->get()]);
    }
}
