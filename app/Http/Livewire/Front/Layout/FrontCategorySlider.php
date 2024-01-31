<?php

namespace App\Http\Livewire\Front\Layout;

use App\Models\Category;
use Livewire\Component;

class FrontCategorySlider extends Component
{
    public function render()
    {
        return view('livewire.front.layout.front-category-slider')
            ->with(['categories' => Category::select(['image_path','title_persian'])
            ->where(['parent_id' => null,'status'=>1])->get()]);
    }
}
