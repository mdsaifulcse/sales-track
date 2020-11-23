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

    public function expenditurePurpose(){
        return [
            '1'=>'Transport Cost',
            '2'=>'Food Cost',
            '3'=>'Phone Bill',
            '4'=>'Accommodation',
            '5'=>'Borrow Repay',
            '6'=>'Borrow(Give)',
            '7'=>'Miscellaneous',
            '8'=>'Foreigner Breakfast',
            '9'=>'Foreigner Launch',
            '10'=>'Foreigner Dinner',
        ];
    }

    public function AdminExpenditurePurpose(){
        return [
            '1'=>'Salary',
            '2'=>'Borrow from Office',
            '3'=>'Repay amount from borrow amount',
            '4'=>'Mobile Bill',
            '5'=>'Monthly Expenditure',
            '6'=>'Foreigner Visit ',
            '7'=>'Foreigner Breakfast',
            '8'=>'Foreigner Launch',
            '9'=>'Foreigner Dinner',
            '10'=>'Driver Salary ',
            '11'=>'Car Maintenance ',
            '12'=>'Car Oil/Gasoline',
            '13'=>'Driver Over Time',
            '14'=>'Driver Launch /Dinner',
            '15'=>'Launch/ Dinner Self',
            '16'=>'Transport Self',
            '17'=>'Miscellaneous',
        ];
    }
}
