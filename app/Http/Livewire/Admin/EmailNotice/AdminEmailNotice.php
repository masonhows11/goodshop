<?php

namespace App\Http\Livewire\Admin\EmailNotice;

use App\Models\PublicMail;
use Livewire\Component;
use Livewire\WithPagination;

class AdminEmailNotice extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $mail_id;

    public function status($id)
    {

        $mail = PublicMail::findOrFail($id);
        if ($mail->status == 0) {
            $mail->status = 1;
        } else {
            $mail->status = 0;

        }
        $mail->save();

        //session()->flash('success', __('messages.The_changes_were_made_successfully'));
        //return redirect()->to('admin/delivery/index');

        $this->dispatchBrowserEvent('show-result',
            ['type' => 'success',
                'message' => __('messages.The_changes_were_made_successfully')]);
    }

    public function deleteConfirmation($id)
    {
        $this->mail_id = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];

    public function deleteModel()
    {
        try {

            $model = PublicMail::findOrFail($this->mail_id);
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
        return view('livewire.admin.email-notice.admin-email-notice')
            ->with(['notices' => PublicMail::paginate(5)]);
    }
}
