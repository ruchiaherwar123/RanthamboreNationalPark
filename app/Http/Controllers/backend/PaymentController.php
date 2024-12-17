<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function payment_success(Request $request)
    {
    $input = $request->all();
    $api = new Api(env('RAZORPAY_KEY'), env('RAZOR_SECRET'));
    if (isset($input['razorpay_payment_id'])) {
        try {
            $payment = $api->payment->fetch($input['razorpay_payment_id']);
            $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(['amount' => $payment['amount']]);
            $input['payment_status'] = 'success';
            Payment::create($input);
            Session::put('confirmMsg', 'Payment successful');
            return redirect()->route('Home.paynow');
        } catch (Exception $e) {
            Session::put('errMsg', $e->getMessage());
            return redirect()->route('Home.paynow');
        }
    } else {
        Session::put('errMsg', 'Payment failed');
        return redirect()->route('Home.paynow');
    }
}

 public function update_payment(Request $request, $id)  
      {  
        $payment = Payment::findOrFail($id); 
        return view('backend_views.update_payment',['data'=>$payment]);
      }

public function submit_update_payment(Request $request, $id)
    {
        $formFields = $request->validate([
            'razorpay_payment_id' => 'required',
            'amount' => 'required',
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'pin_code' => 'required',
            'country' => 'required',
            'pay_for' => 'required',
        ]);
        $formFields['remark']=$request->remark;
        try {
            $payment = Payment::findOrFail($id);
            $payment->update($formFields);
            return redirect(route('show_payment_details'))->with('successMessage', 'Content Update successfully');
        } 
        catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect(route('show_payment_details'))->with('dangerMessage', 'Something Went Wrong');
        }
    }

public function show_payment_details()
  {
    $payment = Payment::paginate(10);
    return view('backend_views.payment_details', ['data' => $payment]);
  }

  public function delete_payment(Request $request, Payment $payment)
  {
    $payment->delete();
    return back()->with('successMessage', 'Content Deleted Successfully');
  }
  
  

}