<?php

namespace App\Http\Controllers\pop;

use App\helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pop.customer.manage', [
            'customers' => Customer::latest()->get(),
            // 'customers' => DB::table('customers')->orderBy('id', 'DESC')
            // ->join('users', 'users.id', '=', 'customers.created_by')
            // ->select('customers.*', 'users.name as created_by')
            // ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pop.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    public function updateOrInsert(Request $request, $id = null)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        $customer = DB::table('customers')->updateOrInsert(['id' => $id], [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'image' => Helper::imageUploader($request->image, 'customers', isset($id) ? DB::table('customers')->find($id)->image : null, 600, 600),
            'address' => $request->address,
            'created_by' => empty($id) ? Auth::user()->id : DB::table('customers')->find($id)->created_by,
            'updated_by' => isset($id) ? Auth::user()->id : null,
            'created_at' => Carbon::now(),
            'updated_at' => isset($id) ? Carbon::now() : null,

        ]);
        if (isset($id)) {
            return redirect()->route('customers.index')->with('success', 'Customer Info Updated Successfully');
        } else {
            return redirect()->back()->with('success', 'New Customer Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pop.customer.edit', [
            'customer' => DB::table('customers')->where('id', $id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('customers')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Customer Deleted Successfully');
    }

    public function customerStatus($id)
    {
        $customer = DB::table('customers')->where('id', $id)->first();
        if ($customer->status == 1) {
            DB::table('customers')->where('id', $id)->update(['status' => 0]);
            $message = 'Customer Deactivate successfully';
        } elseif ($customer->status == 0) {
            DB::table('customers')->where('id', $id)->update(['status' => 1]);
            $message = 'Customer Activate successfully';
        }
        return redirect()->back()->with('success', $message);
    }

    public function customerCredit()
    {

        return view('pop.customer.credit', [
            'credits' => Payment::whereIn('paid_status', ['0', '2'])->orderBy('id', 'DESC')->get(),
        ]);
    }

    public function customerCreditPdf()
    {
        return view('pop.pdf.customer-credit', [
            'credits' => Payment::whereIn('paid_status', ['0', '2'])->orderBy('id', 'DESC')->get(),
        ]);
    }

    public function customerPayment($invoice_id)
    {

        return view('pop.customer.payment', [
            'payment' => Payment::with('invoice_details')->where('invoice_id', $invoice_id)->first(),
        ]);
    }

    public function customerPaymentStore(Request $request, $invoice_id)
    {
        $payment = Payment::where('invoice_id', $request->invoice_id)->first();
        $paymentDetails = new PaymentDetail();
        if ($request->new_payment_amount > $request->due_amount) {
            return redirect()->back()->with('error', 'Maximized Due Amount');
        } else {
            if ($request->paid_status == 1) {
                $payment->paid_status = 1;
                $payment->paid_amount += $request->due_amount;
                $payment->due_amount -= $request->due_amount;

                $paymentDetails->current_paid_amount = $request->due_amount;
                $paymentDetails->updated_by = Auth::user()->id;
                $paymentDetails->invoice_id = $request->invoice_id;
                $paymentDetails->date = Carbon::now();
            } elseif ($request->paid_status == 2) {
                $payment->paid_amount += $request->new_payment_amount;
                $payment->due_amount -= $request->new_payment_amount;

                $paymentDetails->current_paid_amount = $request->new_payment_amount;
                $paymentDetails->invoice_id = $request->invoice_id;
                $paymentDetails->updated_by = Auth::user()->id;
                $paymentDetails->date = Carbon::now();
            }
        }
        $payment->save();
        $paymentDetails->save();
        return redirect()->back()->with('success', 'Paid Successful');
    }

    public function customerPaymentSummary($invoice_id)
    {
        // $payment = Payment::with('invoice_details')->with('payment_details')->where('invoice_id', $invoice_id)->first();
        // return $payment;
        return view('pop.customer.credit-details', [
            'payment' => Payment::with('invoice_details')->with('payment_details')->where('invoice_id', $invoice_id)->first(),
        ]);
    }

    public function customerPaid()
    {
        return view('pop.customer.paid', [
            'credits' => Payment::where('paid_status', '!=', '0')->orderBy('id', 'DESC')->get(),
        ]);
    }
}
