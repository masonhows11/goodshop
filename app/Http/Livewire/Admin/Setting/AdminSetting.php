<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Setting;
use Database\Seeders\SettingSeeder;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSetting extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public function mount(){

        $setting = Setting::first();

        if($setting == null){

            $default = New SettingSeeder();
            $default->run();
            $setting = Setting::first();
        }

    }


    public function render()
    {
        return view('livewire.admin.setting.admin-setting')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with([ 'settings' => Setting::paginate(10)]);
    }
}
