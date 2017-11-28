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

    public function showCustomersId($id)
    {
        $customer = Customer::find($id);

        if ($customer != null) {
            return response()->json($customer);
        } else {
            return response()->json(["message" => "Customer not found"], 404);
        }

    }
}
