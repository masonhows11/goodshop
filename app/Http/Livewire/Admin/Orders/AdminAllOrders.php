<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;


class AdminAllOrders extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $order_id;
    public $order;

    public function changeDeliveryStatus($id)
    {
        $order = Order::findOrfail($id);
        switch ($order->delivery_status){
            case 0:
                $order->delivery_status = 1;
                break;
            case 1:
                $order->delivery_status = 2;
                break;
            case 2:
                $order->delivery_status = 3;
                break;
            default :
                $order->delivery_status = 0;
        }
        $order->save();

        $this->dispatchBrowserEvent('show-result',
            ['type' => 'success',
                'message' => __('messages.The_changes_were_made_successfully')]);

    }

    public function changeOrderStatus($id)
    {
        $order = Order::findOrfail($id);
        switch ($order->order_status){
            case 0:
                $order->order_status = 1;
                break;
            case 1:
                $order->order_status = 2;
                break;
            case 2:
                $order->order_status = 3;
                break;
            case 3:
                $order->order_status = 0;
                break;
            default :
                $order->order_status = 0;
        }
        $order->save();

        $this->dispatchBrowserEvent('show-result',
            ['type' => 'success',
                'message' => __('messages.The_changes_were_made_successfully')]);
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrfail($id);
        $order->order_status = 4;
        $order->save();

        $this->dispatchBrowserEvent('show-result',
            ['type' => 'success',
                'message' => __('messages.The_changes_were_made_successfully')]);
    }




    public function render()
    {
        return view('livewire.admin.orders.admin-all-orders')
            ->extends('dash.include.master_dash')
            ->section('dash_main_content')
            ->with(['orders' => Order::paginate(10)]);
    }
}
