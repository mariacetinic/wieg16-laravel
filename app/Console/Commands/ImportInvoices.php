<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ShippingAddress;
use App\BillingAddress;
use App\Order;
use App\Item;

class ImportInvoices extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importera fakturor';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        $this->info("This is import invoices");
        $ch = curl_init();
        $url="https://www.milletech.se/invoicing/export/";
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result=json_decode(curl_exec($ch), true);
        curl_close($ch);


        foreach($result as $order) {

            //Kolla om modellen redan finns via Customer::find($id). Om modellen inte finns så blir det null
            $this->info("Importing/update order with id: ".$order['id']);


            if ($order['status'] != 'processing') continue; {
                $dbOrder = Order::findOrNew($order['id']);
                $dbOrder->fill($order);
                $dbOrder->save();
            }

            if (isset($order['ShippingAddress']) && is_array($order['shipping_Address'])) {
                $shippingAddress = ShippingAddress::findOrNew($order['shipping_Address']['id']);
                $shippingAddress->fill($order['shipping_address']);
                $shippingAddress->save();
            }

            if (isset($order['BillingAddress']) && is_array($order['billing_address'])) {
                $billingAddress = BillingAddress::findOrNew($order['billing_address']['id']);
                $billingAddress->fill($order['billing_address']);
                $billingAddress->save();
            }

            foreach ($order['items'] as $item) {
                $items = Item::findOrNew($item['id']);
                $items->fill($item);
                $items->save();
            }

        }

    }
}
