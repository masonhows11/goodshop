<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;

class AdminAdmins extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $delete_id;
    public $search = '';
    public $stateUser = true;

    // step 1 : confirm delete alert
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
    // step 2 : add confirm listener
    protected $listeners = [
        'deleteConfirmed' => 'deleteAdmin',
    ];
    // step 3 : delete model on listener
    public function deleteAdmin()
    {
        try {
            Admin::destroy($this->delete_id);
            $this->dispatchBrowserEvent('show-result',
                ['type' => 'success',
                    'message' => 'رکورد با موفقیت حذف شد']);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
        return null;
    }
    public function render()
    {
        return view('livewire.admin.users.admin-admins')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['admins'=> Admin::where('name','like','%'.$this->search.'%')
                ->Orwhere('first_name','like','%'.$this->search.'%')->paginate(5)]);
    }
}
