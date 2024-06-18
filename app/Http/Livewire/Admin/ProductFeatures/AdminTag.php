<?php

namespace App\Http\Livewire\Admin\ProductFeatures;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTag extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $title_persian;
    public $title_english;
    public $delete_id;
    public $tag_id;
    public $edit_mode = false;



    protected function rules()
    {
        return [
            'title_persian' => ['required', Rule::unique('tags')->ignore($this->tag_id), 'min:2', 'max:100'],
            'title_english' => ['required', Rule::unique('tags')->ignore($this->tag_id), 'min:2', 'max:100'],
        ];
    }

    protected $messages = [
        'title_persian.required' => 'عنوان تگ را به فارسی وارد کنید.',
        'title_persian.min' => 'حداقل ۲ کارکتر.',
        'title_persian.max' => 'حداکثر ۱۰۰  کاراکتر.',
        'title_persian.unique' => 'عنوان وارد شده تکراری است.',


        'title_english.required' => 'عنوان تگ را به انگلیسی وارد کنید.',
        'title_english.min' => 'حداقل ۲ کارکتر.',
        'title_english.max' => 'حداکثر ۱۰۰ کاراکتر.',
        'title_english.unique' => 'عنوان وارد شده تکراری است.',

    ];

    public function store()
    {
        $this->validate();
        if ($this->edit_mode == false) {
            try {
                Tag::create(
                    [
                        'title_persian' => $this->title_persian,
                        'title_english' => $this->title_english,
                    ]
                );
                $this->dispatchBrowserEvent(
                    'show-result',
                    [
                        'type' => 'success',
                        'message' => __('messages.New_record_saved_successfully')
                    ]
                );
                //
                $this->title_persian = '';
                $this->title_english = '';
            } catch (\Exception $ex) {
                return view('errors_custom.model_store_error');
            }
        } elseif ($this->edit_mode == true) {
            try {


                $tag =  Tag::findOrFail($this->tag_id);
                $tag->title_persian = $this->title_persian;
                $tag->title_english = $this->title_english;
                // add this line for update slug when update model
                $tag->generateSlug();
                $tag->save();

        
                $this->dispatchBrowserEvent(
                    'show-result',
                    [
                        'type' => 'success',
                        'message' => __('messages.The_update_was_completed_successfully')
                    ]
                );

                $this->title_persian = '';
                $this->title_english = '';
                $this->edit_mode = false;
            } catch (\Exception $ex) {
                return view('errors_custom.model_store_error');
            }
        }
    }

    public function newTag()
    {
        $this->title_persian = '';
        $this->title_english = '';
        $this->edit_mode = false;
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteTag',
    ];

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteTag()
    {
        try {
            Tag::destroy($this->delete_id);
            $this->dispatchBrowserEvent(
                'show-result',
                [
                    'type' => 'success',
                    'message' => __('messages.The_deletion_was_successful')
                ]
            );
            return null;
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
    }

    public function editTag($id)
    {
        $this->edit_mode = true;
        $tag = DB::table('tags')->where('id', $id)->first();
        $this->title_persian = $tag->title_persian;
        $this->title_english = $tag->title_english;
        $this->slug = $tag->slug;
        $this->tag_id = $tag->id;
    }

    public function render()
    {
        return view('livewire.admin.product-features.admin-tag')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['tags' => Tag::paginate(10)]);
    }
}
