<?php

namespace App\Http\Livewire\Admin\Delivery;

use App\Models\Delivery;

use Livewire\Component;
use Livewire\WithPagination;

class AdminDelivery extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $delivery_id;

    public function status($id)
    {

        $delivery = Delivery::findOrFail($id);
        if ($delivery->status == 0) {
            $delivery->status = 1;
        } else {
            $delivery->status = 0;

        }
        $delivery->save();

        //session()->flash('success', __('messages.The_changes_were_made_successfully'));
        //return redirect()->to('admin/delivery/index');

        $this->dispatchBrowserEvent('show-result',
            ['type' => 'success',
                'message' => __('messages.The_changes_were_made_successfully')]);
    }

    public function deleteConfirmation($id)
    {
        $this->delivery_id = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];

    public function deleteModel()
    {
        try {

            $model = Delivery::findOrFail($this->delivery_id);
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
        return view('livewire.admin.delivery.admin-delivery')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['deliveries' => Delivery::paginate(10)]);
    }
}
