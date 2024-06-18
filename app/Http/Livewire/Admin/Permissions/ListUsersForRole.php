<?php

namespace App\Http\Livewire\Admin\Permissions;

use App\Models\Admin;

use Livewire\Component;
use Livewire\WithPagination;

class ListUsersForRole extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.permissions.list-users-for-role')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['users' => Admin::paginate(5)]);
    }
}
