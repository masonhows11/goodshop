<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class AdminBrands extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $search = '';


    public function updatingSearch()
    {
        $this->resetPage();
    }
    use WithPagination;
    public $delete_id;
    public $brand_active = true;
    public $brand_id;

    public function active($id)
    {
        $this->brand_id = $id;

        $brand = Brand::findOrFail($id);
        if ($brand->is_active == 0) {
            $brand->is_active = 1;
            $this->brand_active = true;
            $brand->save();
        } else {
            $brand->is_active = 0;
            $this->brand_active = false;
            $brand->save();
        }
        $this->dispatchBrowserEvent('show-result',
            ['type' => 'success',
                'message' => __('messages.The_changes_were_made_successfully')]);

    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteBrand',
    ];

    public function deleteBrand()
    {
        try {

            $brand = Brand::findOrFail($this->delete_id);
            if($brand->logo_path != null){
                Storage::disk('public')->delete('/images/'.$brand->logo_path);
            }
            $brand->delete();
            $this->dispatchBrowserEvent('show-result',
                ['type' => 'success',
                    'message' => __('messages.The_deletion_was_successful')]);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
        return null;
    }

    public function render()
    {
        return view('livewire.admin.admin-brands')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['brands' => Brand::where('title_persian','like','%'.$this->search.'%')
                ->OrWhere('title_english','like','%'.$this->search.'%')->paginate(9)]);
    }
}
