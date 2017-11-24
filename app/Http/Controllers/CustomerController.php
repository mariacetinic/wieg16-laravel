<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function showCustomer() {
        return response()->json(Customer::all());
        //header('Content-Type: application/json');
    }
}
