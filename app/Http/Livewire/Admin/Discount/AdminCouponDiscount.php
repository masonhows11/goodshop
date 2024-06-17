<?php

namespace App\Http\Livewire\Admin\Discount;

use App\Models\AmazingSales;
use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCouponDiscount extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $coupon_id;
    public $coupon;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function changeStatus($id)
    {
        $this->coupon = Coupon::findOrFail($id);

        if($this->coupon->status == 1){
            $this->coupon->status = 0;
        }else{
            $this->coupon->status = 1;
        }
        $this->coupon->save();

        // session()->flash('success', __('messages.The_changes_were_made_successfully'));
        // return redirect()->route('admin.common.amazingSale.index');

        $this->dispatchBrowserEvent('show-result',
            ['type' => 'success',
                'message' => __('messages.The_changes_were_made_successfully')]);
    }

    public function deleteConfirmation($id)
    {
        $this->coupon_id = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];

    public function deleteModel()
    {
        try {


            $model = Coupon::findOrFail($this->coupon_id);
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
        return view('livewire.admin.discount.admin-coupon-discount')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['coupons' => Coupon::paginate(10)]);
    }
}
