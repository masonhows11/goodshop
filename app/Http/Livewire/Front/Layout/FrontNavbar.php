<?php

namespace App\Http\Livewire\Front\Layout;

use App\Models\Category;
use Livewire\Component;

class FrontNavbar extends Component
{
    public function render()
    {
        return view('livewire.front.layout.front-navbar')
            ->with(['categories' => Category::where('status',1)->tree()->get()->toTree()]);
    }
}
