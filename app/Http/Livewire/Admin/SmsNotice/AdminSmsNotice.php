<?php

namespace App\Http\Livewire\Admin\SmsNotice;

use App\Models\PublicSms;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSmsNotice extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sms_id;

    public function status($id)
    {

        $sms = PublicSms::findOrFail($id);
        if ($sms->status == 0) {
            $sms->status = 1;
        } else {
            $sms->status = 0;

        }
        $sms->save();

        //session()->flash('success', __('messages.The_changes_were_made_successfully'));
        //return redirect()->to('admin/delivery/index');

        $this->dispatchBrowserEvent('show-result',
            ['type' => 'success',
                'message' => __('messages.The_changes_were_made_successfully')]);
    }

    public function deleteConfirmation($id)
    {
        $this->sms_id = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];

    public function deleteModel()
    {
        try {

            $model = PublicSms::findOrFail($this->sms_id);
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
        return view('livewire.admin.sms-notice.admin-sms-notice')
            ->with(['notices' => PublicSms::paginate(5)]);
    }
}
