<?php

namespace App\Http\Controllers\pop;

use App\Models\Unit;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('pop.invoice.index', [
            'invoices' => Invoice::where('status', 1)->latest()->get(),
        ]);
    }
    public function create()
    {
        return view('pop.invoice.create', [
            'categories' => Category::where('status', 1)->orderBy('name', 'ASC')->get(),
            'date' => date('Y-m-d'),
            'customers' => Customer::where('status', 1)->orderBy('name', 'ASC')->get(),
        ]);
    }

    public function getProductQuantity(Request $request)
    {
        $productId = $request->product_id;
        $stock = Product::where('id', $productId)->first();
        return response()->json($stock);
    }

    public function store(Request $request)
    {

        if ($request->product_id == null) {
            return redirect()->back()->with('error', 'Please Select product first !');
        } else {
            if ($request->paid_amount > $request->grand_total) {
                return redirect()->back()->with('error', 'Paid amount exceeding!');
            } else {
                $invoice = new Invoice();
                $invoice->invoice_no = Invoice::max('invoice_no') + 1;
                $invoice->date = date('Y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->created_by = Auth::user()->id;

                DB::transaction(function () use ($request, $invoice) {
                    if ($invoice->save()) {
                        $count = count($request->product_id);
                        for ($i = 0; $i < $count; $i++) {
                            $invoiceDetail = new InvoiceDetail();
                            $invoiceDetail->invoice_id = $invoice->id;
                            $invoiceDetail->category_id = $request->category_id[$i];
                            $invoiceDetail->product_id = $request->product_id[$i];
                            $invoiceDetail->quantity = $request->quantity[$i];
                            $invoiceDetail->unit_price = $request->unit_price[$i];
                            $invoiceDetail->total_price = $request->total_price[$i];
                            $invoiceDetail->save();
                        }
                        //create new customer
                        if ($request->customer_id == 0) {
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->phone = $request->phone;
                            $customer->email = $request->email;
                            $customer->created_by = Auth::user()->id;
                            $customer->save();
                            $customerId = $customer->id;
                        } else {
                            $customerId = $request->customer_id;
                        }
                        // payment
                        $payment = new Payment();
                        $paymentDetail = new PaymentDetail();
                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customerId;
                        $payment->paid_status = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->grand_total;

                        if ($request->paid_status == 1) {
                            $payment->paid_amount = $request->grand_total;
                            $payment->due_amount = 0;
                            $paymentDetail->current_paid_amount = $request->grand_total;
                        } elseif ($request->paid_status == 0) {
                            $payment->paid_amount = 0;
                            $payment->due_amount = $request->grand_total;
                            $paymentDetail->current_paid_amount = 0;
                        } elseif ($request->paid_status == 2) {
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->grand_total - $request->paid_amount;
                            $paymentDetail->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();

                        $paymentDetail->invoice_id = $invoice->id;
                        $paymentDetail->date = date('Y-m-d', strtotime($request->date));
                        $paymentDetail->save();
                    }
                });
            }
        }
        return redirect()->back()->with('success', 'Inserted successfully');
    } // End Method

    public function invoicePending()
    {
        return view('pop.invoice.pending', [
            'invoices' => Invoice::where('status', 0)->latest()->get(),
        ]);
    }

    public function invoiceDestroy($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $invoice->delete();
        InvoiceDetail::where('invoice_id', $invoice->id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        PaymentDetail::where('invoice_id', $invoice->id)->delete();
        return redirect()->back()->with('success', 'Invoice Deleted Successfully');
    }

    public function invoiceDetails($id)
    {
        // $products = Invoice::with('invoiceDetails')->find($id);
        // return $products;

        return view('pop.invoice.details', [
            // 'invoice' => Invoice::where('id', $id)->first(),
            'invoice' => Invoice::with('invoice_details')->find($id),
        ]);
    }
    public function invoiceApprove(Request $request, $id)
    {
        foreach ($request->quantity as $invoiceDetailId => $value) {
            $invoiceDetail = InvoiceDetail::where('id', $invoiceDetailId)->first();
            $product = Product::where('id', $invoiceDetail->product_id)->first();
            if ($request->quantity[$invoiceDetailId] > $product->quantity) {
                return redirect()->back()->with('error', 'Product Stock Out !');
            }
        } //End foreach
        $invoice = Invoice::where('id', $id)->first();
        $invoice->status = 1;
        $invoice->approve_by = Auth::user()->id;
        DB::transaction(function () use ($request, $invoice, $id) {
            foreach ($request->quantity as $invoiceDetailId => $value) {
                $invoiceDetail = InvoiceDetail::where('id', $invoiceDetailId)->first();
                $product = Product::where('id', $invoiceDetail->product_id)->first();
                $product->quantity = ((float)$product->quantity) - ((float)$request->quantity[$invoiceDetailId]);
                $product->save();
            }
            $invoice->save();
        });
        return redirect()->back()->with('success', 'Invoice approved successfully !');
    }

    public function invoiceDaily()
    {
        return view('pop.invoice.daily-invoice');
    }

    public function invoiceDailySearch(Request $request)
    {
        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        // return $request->all();
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        return view('pop.pdf.daily-invoice', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'invoices' => Invoice::whereBetween('date', [$startDate, $endDate])->where('status', 1)->get(),
        ]);
    }
}
