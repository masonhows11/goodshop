<?php

namespace App\Http\Livewire\Front\Layout;

use App\Models\Category;
use Livewire\Component;

class FrontCategory extends Component
{
    public function render()
    {
        return view('livewire.front.layout.front-category')
            ->with(['categories' => Category::select(['image_path','title_persian'])
            ->where(['parent_id' => null,'status'=>1])->get()]);
    }
}
