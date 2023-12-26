<?php

namespace App\Http\Livewire\Admin\City;

use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;

class Cities extends Component
{

    public $province_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount($province){

        $this->province_id  = $province;
    }

    public function render()
    {
        return view('livewire.admin.city.cities')
            ->with(['cities'=> City::where('province_id',$this->province_id)
                ->where('deleted_at','=',null)
                ->paginate(5)]);
    }
}
