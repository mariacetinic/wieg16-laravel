<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KlarnaController extends Controller
{
    public function index(){
        $orderData = array();

        $orderData['order_lines'] = array(
            array(
                "type" => "physical",
                "reference" => "123050",
                "name" => "Tomatoes",
                "quantity" => 10,
                "quantity_unit" => "kg",
                "unit_price" => 600,
                "tax_rate" => 2500,
                "total_amount" => 6000,
                "total_tax_amount" => 1200
            ),
            array(
                "type" => "physical",
                "reference" => "543670",
                "name" => "Bananas",
                "quantity" => 1,
                "quantity_unit" => "bag",
                "unit_price" => 5000,
                "tax_rate" => 2500,
                "total_amount" => 4000,
                "total_discount_amount" => 1000,
                "total_tax_amount" => 800
            )
        );

        //

        $merchantUrls = [
            'terms' =>  'http://medielaravel.dev/',
            'checkout' =>  'http://medielaravel.dev/klarna?klarna_order_id={checkout.order.id}',
            'confirmation' =>  'http://medielaravel.dev/klarna-confirmation?klarna_order_id={checkout.order.id}',
            'push' =>  'http://medielaravel.dev/klarna-push?klarna_order_id={checkout.order.id}'
        ];

        $orderData['purchase_country'] = 'se';
        $orderData['purchase_currency'] = 'sek';
        $orderData['locale'] = 'sv-SE';
        $orderData['order_amount'] = 10000;
        $orderData['order_tax_amount'] = 2000;

        $orderData['merchant_urls'] = $merchantUrls;

        //

        $connector = \Klarna\Rest\Transport\Connector::create(
            'PK00431_7c8212b6a13a',
            'X1JwojFv5vFn9hM6',
            \Klarna\Rest\Transport\ConnectorInterface::EU_TEST_BASE_URL
        );

        $checkout = new \Klarna\Rest\Checkout\Order($connector);
        $checkout->create($orderData);

        $checkout->fetch();

        return view("klarna/index", ['checkout' => $checkout]);
    }

    public function confirmation(Request $request) {
        $merchantUrls = [
            'terms' => 'http://medielaravel.dev',
            'checkout' => 'http://medielaravel.dev/klarna?klarna_order_id={checkout.order.id}',
            'confirmation' => 'http://medielaravel.dev/klarna-confirmation?klarna_order_id={checkout.order.id}',
            'push' => 'http://medielaravel.dev/klarna-push?klarna_order_id={checkout.order.id}' //klarna skickar data till när transaktioner sker. man ska svara klarna
        ];

        $orderId = $request->input('klarna_order_id');

        $connector = \Klarna\Rest\Transport\Connector::create(
            'PK00431_7c8212b6a13a',
            'X1JwojFv5vFn9hM6',
            \Klarna\Rest\Transport\ConnectorInterface::EU_TEST_BASE_URL
        );

        $checkout = new \Klarna\Rest\Checkout\Order($connector, $orderId);

        $checkout->fetch();
        return view("klarna/confirmation", [
            'checkout' => $checkout,
            'orderId' => $orderId
        ]);

    }

    public function acknowledge(Request $request) {
        $orderId = $request->input('order_id');
        $response = ['message' => 'ok'];
        $code = 200;

        try {
            $connector = \Klarna\Rest\Transport\Connector::create(
                 'PK00431_7c8212b6a13a',
                 'X1JwojFv5vFn9hM6',
                \Klarna\Rest\Transport\ConnectorInterface::EU_TEST_BASE_URL
            );

            $order = new \Klarna\Rest\OrderManagement\Order(
                $connector,
                $orderId
            );

            $order->fetch();
            $order->acknowledge();
        }

        catch (\Exception $e) {
            $response=['message' => '$e->getMessage'];
            $code = 500;
        }
        return response()->json($response, $code);
    }
}
