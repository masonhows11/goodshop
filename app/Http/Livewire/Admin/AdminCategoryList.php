<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryList extends Component
{
    use WithPagination;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $search = '';


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public $delete_id;

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteCategory',
    ];

    public function deleteCategory()
    {
        $category = Category::findOrFail($this->delete_id);

        try {
            if ($category->parent_id == null) {
                $this->dispatchBrowserEvent('show-result',
                    ['type' => 'warning',
                        'message' => __('messages.It_is_not_possible_to_delete')]);
            } else {
                if ($category->image_path != null) {
                    Storage::disk('public')->delete('/images/category/' . $category->image_path);
                }
                $category->delete();
                $this->dispatchBrowserEvent('show-result',
                    ['type' => 'success',
                        'message' => __('messages.The_deletion_was_successful')]);

            }
        } catch (\Exception $ex) {
            session()->flash('error', __('messages.The_desired_record_does_not_exist'));
        }
        return null;
    }

    public function detachCategory($id)
    {
        try {
            $category = Category::find($id);
            if ($category->parent_id != null) {
                $category->parent_id = null;
                $category->save();
                session()->flash('success', __('messages.The_category_was_removed_from_its_parent'));
                return redirect()->to('/admin/category/index');
            }
        } catch (\Exception $ex) {
            session()->flash('error', __('messages.The_desired_record_does_not_exist'));

        }
    }

    public function changeState($id)
    {
        try {
            $category = Category::findOrFail($id);
            if ($category->is_active == 0) {
                $category->is_active = 1;
                $this->is_active = 1;
            } else {
                $category->is_active = 0;
                $this->is_active = 0;
            }
            $category->save();

            $this->dispatchBrowserEvent('show-result',
                ['type' => 'success',
                    'message' => __('messages.The_changes_were_made_successfully')]);
        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('show-result',
                ['type' => 'error',
                    'message' => __('messages.An_error_occurred')]);
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-category-list')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['categories' => Category::where('title_persian','like','%'.$this->search.'%')
                ->Orwhere('title_english','like','%'.$this->search.'%')->paginate(10)]);
        // ->with(['category_tree'=>Category::tree()->get()->toTree()]);
    }
}
