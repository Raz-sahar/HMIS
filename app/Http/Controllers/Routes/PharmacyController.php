<?php

namespace App\Http\Controllers\Routes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function company()
    {
        return view('pharmacy.company');
    }
    public function supplier()
    {
        return view('pharmacy.supplier');
    }
    public function packing()
    {
        return view('pharmacy.packing');
    }
    public function product()
    {
        return view('pharmacy.product');
    }
    public function stock()
    {
        return view('pharmacy.stock');
    }

    public function purchase()
    {
        return view('pharmacy.purchase');
    }
    public function purchase_detail()
    {
        return view('pharmacy.purchase_detail');
    }
    public function invoice()
    {
        return view('pharmacy.invoice');
    }
    public function invoice_detail()
    {
        return view('pharmacy.invoice_detail');
    }

    public function return_invoice()
    {
        return view('pharmacy.return_invoice');
    }
    public function return_invoice_detail()
    {
        return view('pharmacy.return_invoice_detail');
    }

}
