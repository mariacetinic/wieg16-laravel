<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\CustomerAddress;

class CustomerController extends Controller
{
    public function showCustomer() {
        return response()->json(Customer::all());
        //header('Content-Type: application/json');
    }

    public function showCustomersId($id)
    {
        $customer = Customer::find($id);


        //uppgift 4
        if ($customer != null) {
            return response()->json($customer);
        } else {
            return response()->json(["message" => "Customer not found"], 404);
        }

    }

    public function showCustomerAddress($customer_id)
    {
        $customerAddress = CustomerAddress::find($customer_id);

        if ($customerAddress == null) {
            $code = 404;
            $response = ['message' => 'Address not found'];
            header("content-type: application/json", true, $code);
            echo json_encode($response);
        } else {
            $result = response()->json($customerAddress);
            return $result;
        }
    }



}
