<?php

namespace App\Http\Livewire\Admin\Comment;

use App\Models\Comment;
use Livewire\Component;

class AdminSingleComment extends Component
{
    public $comment;
    public $comment_id;
    public $product_id;
    public $body;

    public function mount($comment)
    {

        $this->comment_id = $comment;
        $this->comment = Comment::findOrFail($comment);
        if($this->comment->seen == 0){
            $this->comment->seen = 1;
            $this->comment->save();
        }
        $this->product_id = $this->comment->product_id;

    }

    protected $rules = [
        'body' => ['required', 'min:2', 'max:1000'],
    ];

    public function save()
    {
        $this->validate();

        try {
            Comment::create([
                'user_id' => 1,
                'parent_id' => $this->comment_id,
                'product_id' => $this->product_id,
                'body' => $this->body,
            ]);
            session()->flash('success', __('messages.The_deletion_was_successful'));
            return redirect()->to('admin/comments/index/product/' . $this->product_id);
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }

    }

    public function render()
    {
        return view('livewire.admin.comment.admin-single-comment')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['comment' => $this->comment]);
    }
}
