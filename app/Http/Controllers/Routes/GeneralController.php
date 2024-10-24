<?php

namespace App\Http\Controllers\Routes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    //
    public function department(){
        return view('general.department');

    }

    

    public function designation(){

        return view('general.designation');

    }
}
