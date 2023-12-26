<?php

namespace App\Http\Livewire\Admin\Comment;

use App\Models\Comment;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminComment extends Component
{

    public $product;
   // public $comments;
    public $product_id;
    public $comment_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount($product)
    {


        $this->product_id = $product;
        $this->product = Product::where('id', $product)
            ->select('id', 'title_persian', 'title_english', 'thumbnail_image', 'short_description', 'created_at')->first();
       // $this->comments = Comment::where('product_id', $product)->get();

    }

    public function approved($id)
    {


        $comment = Comment::findOrFail($id);
        if ($comment->status == 0) {
            $comment->status = 1;
            $comment->approved = 1;
            $comment->seen = 1;
        } else {
            $comment->status = 0;
            $comment->approved = 0;
            $comment->seen = 0;
        }
        $comment->save();

        session()->flash('success', __('messages.The_changes_were_made_successfully'));
        return redirect()->to('admin/comments/index/product/' . $this->product_id);

        //        $this->dispatchBrowserEvent('show-result',
        //            ['type' => 'success',
        //             'message' => __('messages.The_changes_were_made_successfully')]);
    }

    public function deleteConfirmation($id)
    {
        $this->comment_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteModel',
    ];

    public function deleteModel()
    {
        try {

            $model = Comment::findOrFail($this->comment_id);
            $model->delete();
            // session()->flash('success', __('messages.The_deletion_was_successful'));
            // return redirect()->to('admin/comments/index/product/'.$this->product_id);
            $this->dispatchBrowserEvent('show-result',
                ['type' => 'success',
                    'message' => __('messages.The_deletion_was_successful')]);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
        // return null;
    }

    public function render()
    {
        return view('livewire.admin.comment.admin-comment')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['product' => $this->product,
                'comments' => Comment::where('product_id', $this->product_id)->paginate(8)]);
    }
}
