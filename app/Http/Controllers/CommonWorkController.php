<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonWorkController extends Controller
{
    public function status(){
        return [
            '1'=>'Follow Up Needed',
            '2'=>'No Need Follow Up',
            '3'=>'Need Quotation',
            '4'=>'Quotation Submitted',
            '5'=>'Fail TO Sell',
            '6'=>'Success TO Sell',
            '7'=>'Technical Discussion',
            '8'=>'PI Needed',
            '9'=>'PI Submitted',
            '10'=>'Draft LC Open',
            '11'=>'LC Open',
        ];
    }
}
