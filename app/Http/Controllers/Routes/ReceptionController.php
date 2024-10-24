<?php

namespace App\Http\Controllers\Routes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    public function patient()
    {
        return view('reception.patient');
    }
    public function fee()
    {
        return view('reception.fee');
    }
    public function service_type()
    {
        return view('reception.service-type');
    }
    public function service()
    {
        return view('reception.service');
    }
    public function fee_receipt()
    {
        return view('reception.fee.receipt');
    }

    public function service_receipt()
    {
        return view('reception.service.receipt');
    }
    public function invoice_receipt()
    {
        return view('reception.invoice.receipt');
    }

    public function return_receipt()
    {
        return view('reception.return.invoice.receipt');
    }

}