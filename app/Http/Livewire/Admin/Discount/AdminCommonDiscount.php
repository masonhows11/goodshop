<?php

namespace App\Http\Livewire\Admin\Discount;

use App\Models\CommonDiscount;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCommonDiscount extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $discount_id;
    public $discount;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function changeStatus($id)
    {
       $this->discount = CommonDiscount::findOrFail($id);
       if($this->discount->status == 1){
           $this->discount->status = 0;
       }else{
           $this->discount->status = 1;
       }
       $this->discount->save();
       $this->dispatchBrowserEvent('show-result',
            ['type' => 'success',
                'message' => __('messages.The_changes_were_made_successfully')]);


      
    }

    public function deleteConfirmation($id)
    {
        $this->discount_id = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];

    public function deleteModel()
    {
        try {

            $model = CommonDiscount::findOrFail($this->discount_id);
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
        return view('livewire.admin.discount.admin-common-discount')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['discounts' => CommonDiscount::paginate(10)]);
    }
}
