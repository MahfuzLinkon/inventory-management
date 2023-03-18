<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard.dashboard', [
            'customers' => Customer::count(),
            'suppliers' => Supplier::count(),
            'categories' => Category::count(),
            'invoices' => Invoice::latest()->get(),
        ]);
    }
}
