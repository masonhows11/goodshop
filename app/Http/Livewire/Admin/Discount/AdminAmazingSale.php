<?php

namespace App\Http\Livewire\Admin\Discount;

use App\Models\AmazingSales;
use Livewire\Component;
use Livewire\WithPagination;

class AdminAmazingSale extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $amazing_id;
    public $amazingSale;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function changeStatus($id)
    {
        $this->amazingSale = AmazingSales::findOrFail($id);
        if($this->amazingSale->status == 1){
            $this->amazingSale->status = 0;
        }else{
            $this->amazingSale->status = 1;
        }
        $this->amazingSale->save();
        $this->dispatchBrowserEvent('show-result',
            ['type' => 'success',
                'message' => __('messages.The_changes_were_made_successfully')]);

        // session()->flash('success', __('messages.The_changes_were_made_successfully'));
        // return redirect()->route('admin.common.amazingSale.index');

    }

    public function deleteConfirmation($id)
    {
        $this->amazing_id = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];

    public function deleteModel()
    {
        try {


            $model = AmazingSales::findOrFail($this->amazing_id);
            $model->delete();
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
        return view('livewire.admin.discount.admin-amazing-sale')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['amazingSales' => AmazingSales::paginate(10)]);
    }
}
