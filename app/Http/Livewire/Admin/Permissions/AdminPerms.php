<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class AdminPerms extends Component
{
    public $name;
    public $perm_id;
    public $delete_id;
    public $edit_mode = false;

    protected function rules()
    {
        return [
            'name' => ['required', 'unique:permissions,name', 'min:2', 'max:30'],
        ];
    }

    protected $messages = [
        'name.required' => 'نام مجوز الزامی است',
        'name.unique' => 'نام مجوز تکراری است',
        'name.min' => 'حداقل ۲ کاراکتر وارد کنید',
        'name.max' => 'حداکثر تعداد کاراکتر مجاز',

    ];

    public function storePerm()
    {
        $this->validate();
        try {
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
            if ($this->edit_mode == false)
            {
                Permission::create(['name' => $this->name]);
                $this->dispatchBrowserEvent('show-result',
                    ['type'=>'success',
                        'message'=>__('messages.New_record_saved_successfully')]);
                $this->name = '';
            }
            elseif ($this->edit_mode == true)
            {
                DB::table('permissions')
                    ->where('id', $this->perm_id)
                    ->update(['name' => $this->name]);
                $this->name = '';
                $this->edit_mode = false;
                $this->dispatchBrowserEvent('show-result',
                    ['type'=>'success',
                        'message'=>__('messages.The_update_was_completed_successfully')]);
            }
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }
        return null;
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
    protected $listeners = [
        'deleteConfirmed'=> 'deletePerm'
    ];
    public function deletePerm()
    {
        try {
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
            Permission::destroy($this->delete_id);
            $this->dispatchBrowserEvent('show-result',
                ['type' => 'success',
                    'message' => __('messages.The_deletion_was_successful')]);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
        return null;
    }

    public function editPerm($id)
    {
        try {
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
            $this->edit_mode = true;
            $perm = DB::table('permissions')->where('id', $id)->first();
            $this->name = $perm->name;
            $this->perm_id = $perm->id;
        }catch (\Exception $ex){
            return view('errors_custom.model_store_error');
        }
        return null;
    }

    public function render()
    {
        return view('livewire.admin.admin-perms')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['perms' => Permission::paginate(10)]);
    }
}
