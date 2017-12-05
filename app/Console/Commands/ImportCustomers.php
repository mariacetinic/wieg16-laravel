<?php

namespace App\Console\Commands;

use App\Customer;
use App\Company;
//use App\CustomerAdress;
use App\CustomerAddress;
use Illuminate\Console\Command;

class ImportCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importera kunder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("This is import customers");

        //  Initiate curl
        $ch = curl_init();
        $url="https://www.milletech.se/invoicing/export/customers";

        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
        // Execute
        $result=json_decode(curl_exec($ch), true);
        // Closing
        curl_close($ch);


        foreach($result as $customer) {
            //Kolla om modellen redan finns via Customer::find($id). Om modellen inte finns så blir det null
            $this->info("Importing customer: ".$customer['id']);
            $dbCustomer = Customer::findOrNew($customer['id']);
            //Spara med $customer->save()
            $dbCustomer->fill($customer)->save();

            if (isset($customer['address']) && is_array($customer['address'])) {
                $this->info("Importing or updating addresses" . $customer['address']['id']);
                $address = CustomerAddress::findOrNew($customer['address']['id']);
                $address->fill($customer['address'])->save();
            }

            if ($dbCustomer->customer_company != null) {
                $company = Company::firstOrNew(['company_name' => $dbCustomer->customer_company]);
                $company->save();

                // UPDATE customers SET company_id = $company->id WHERE customer_company = $company->company_name
                \DB::table('customers')
                    ->where("customer_company", "=", $company->company_name)
                    ->update(["company_id" => $company->id]);
            }

        }
    }
}
