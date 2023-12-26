<?php

namespace App\Http\Livewire\Front\Comment;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AddComment extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $product;
    public $product_id;
    public $body;
    public $comment_count;
  //  public $rated_value;



    public function mount($product)
    {

        $this->product = Product::findOrfail($product);
        //        if(Auth::check()){
        //           $this->rated_value = intval(Auth::user()->getRatingValue($this->product));
        //        }


        $this->product_id = $this->product->id;
        $this->comment_count = Comment::where(['product_id' => $this->product_id, 'approved' => 1])->count();

    }

    protected $rules = [
        'body' => ['required', 'min:5', 'max:2000', 'string'],
    ];

    public function addComment()
    {
        $this->validate();
        try {
            Comment::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product_id,
                'body' => $this->body,
            ]);
            $this->body = '';
            session()->flash('success', __('messages.your_comment_has_been_successfully_submitted_and_will_be_displayed_after_review'));
            return null;
        } catch (\Exception $ex) {
            session()->flash('error', __('messages.An_error_occurred'));

        }
        //            return view('errors_custom.model_store_error')
        //                ->with(['error' => $ex->getMessage()]);
        // return redirect()->route('product.details',['product'=> $this->product->slug ]);
        //            $this->dispatchBrowserEvent('show-result',
        //                ['type' => 'success',
        //                    'message' => __('messages.your_comment_has_been_registered_and_will_be_displayed_after_review')]);
    }


    public function addRate($rate)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form');
        }
        try {
            $user = auth()->user();
            $user->rate($this->product, intval($rate));
            return null;
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }
    }


    public function guest_add_Rate(){

        if (!Auth::check()) {
            return redirect()->route('auth.login.form');
        }
        return null;
    }


    public function render()
    {
        return view('livewire.front.comment.add-comment')
            ->with(['comments' => Comment::where(['product_id' => $this->product_id, 'approved' => 1, 'parent_id' => null])->paginate(10),
                'comments_count' => $this->comment_count,
                'product_id' => $this->product_id,
                'rate_avg' => $this->product->ratingsAvg(),
                'total_rate' => $this->product->ratingsCount(),
                'rated_value' => intval(Auth::user() == true ? Auth::user()->getRatingValue($this->product) : null),]);

    }
}
