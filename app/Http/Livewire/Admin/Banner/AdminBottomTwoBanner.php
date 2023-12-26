<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\bottomTwoBanner;
use Livewire\Component;
use Livewire\WithPagination;

class AdminBottomTwoBanner extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $banner_id;

    public function status($id)
    {

        $banner = bottomTwoBanner::findOrFail($id);
        if ($banner->status == 0) {
            $banner->status = 1;
        } else {
            $banner->status = 0;

        }
        $banner->save();

        //session()->flash('success', __('messages.The_changes_were_made_successfully'));
        //return redirect()->to('admin/banner/index');

        $this->dispatchBrowserEvent('show-result',
            ['type' => 'success',
                'message' => __('messages.The_changes_were_made_successfully')]);
    }

    public function deleteConfirmation($id)
    {
        $this->banner_id = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];

    public function deleteModel()
    {
        try {

            $model = bottomTwoBanner::findOrFail($this->banner_id);
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
        return view('livewire.admin.banner.admin-bottom-two-banner')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['banners' => bottomTwoBanner::paginate(10)]);
    }
}
