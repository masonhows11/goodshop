<?php

namespace App\Http\Controllers\Dash\Payment;

use App\Http\Controllers\Controller;
use App\Models\CashPayment;
use App\Models\OfflinePayment;
use App\Models\OnlinePayment;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function index()
    {
        return view('dash.payment.index')->with(['payments' => Payment::paginate(20)]);
    }

    public function offline()
    {
        $payments = Payment::where('paymentable_type', 'App\Models\OfflinePayment')->paginate(20);
        return view('dash.payment.offline_payments', ['payments' => $payments]);
    }

    public function online()
    {

        $payments = Payment::where('paymentable_type', 'App\Models\OnlinePayment')->paginate(20);
        return view('dash.payment.online_payments', ['payments' => $payments]);
    }

    public function cash()
    {
        $payments = Payment::where('paymentable_type', 'App\Models\CashPayment')->paginate(20);
        return view('dash.payment.cash_payments', ['payments' => $payments]);
    }

    public function canceled(Payment $payment)
    {
        $payment->status = 2;
        $payment->save();
        session()->flash('success', __('messages.The_changes_were_made_successfully'));
        return redirect()->route('admin.payments.all.index');
    }

    public function retuned(Payment $payment)
    {
        $payment->status = 3;
        $payment->save();
        session()->flash('success', __('messages.The_changes_were_made_successfully'));
        return redirect()->route('admin.payments.all.index');
    }

    public function show(Payment $payment){

        return view('dash.payment.payment',['payment'=>$payment]);
    }


}
