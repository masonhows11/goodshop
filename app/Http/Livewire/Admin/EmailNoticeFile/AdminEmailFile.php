<?php

namespace App\Http\Livewire\Admin\EmailNoticeFile;

use App\Models\PublicMail;
use App\Models\PublicMailFile;
use App\Services\file\FileService;
use Livewire\Component;
use Livewire\WithPagination;

class AdminEmailFile extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $file_id;
    public $mail_id;
    public $mail;

    public function mount($file){

        $this->mail_id = $file;
        $this->mail = PublicMail::findOrFail($file);

    }

    public function status($id)
    {

        $file = PublicMailFile::findOrFail($id);
        if ($file->status == 0) {
            $file->status = 1;
        } else {
            $file->status = 0;

        }
        $file->save();

        //session()->flash('success', __('messages.The_changes_were_made_successfully'));
        //return redirect()->to('admin/delivery/index');

        $this->dispatchBrowserEvent('show-result',
            ['type' => 'success',
                'message' => __('messages.The_changes_were_made_successfully')]);
    }

    public function deleteConfirmation($id)
    {
        $this->file_id = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];

    public function deleteModel()
    {
        try {
            $model = PublicMailFile::findOrFail($this->file_id);
            if($model->file_path != null ){
                $fileService = new FileService();
                $fileService->deleteFile($model->file_path);
            }
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
        return view('livewire.admin.email-notice-file.admin-email-file')
            ->with(['files' => PublicMailFile::where('public_mail_id',$this->mail_id)->paginate(5),
                    'mail'=> $this->mail]);
    }
}
