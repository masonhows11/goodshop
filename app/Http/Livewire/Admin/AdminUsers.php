<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUsers extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $delete_id;
    public $search = '';
    public $stateUser = true;

    public function activeUser($id)
    {
        $user = User::find($id);
        if ($user->activate == 0) {
            $user->activate = 1;
            $user->save();
            $this->stateUser = true;
        } else {
            $user->activate = 0;
            $user->save();
            $this->stateUser = false;
        }
    }

    // step 1 : confirm delete alert
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
    // step 2 : add confirm listener
    protected $listeners = [
        'deleteConfirmed' => 'deleteUser',
    ];
    // step 3 : delete model on listener
    public function deleteUser()
    {
        try {
            User::destroy($this->delete_id);
            $this->dispatchBrowserEvent('show-result',
                ['type' => 'success',
                    'message' => 'رکورد با موفقیت حذف شد']);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
        return  null;
    }
    public function render()
    {
        return view('livewire.admin.admin-users')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['users' => User::paginate(8)]);
    }
}
