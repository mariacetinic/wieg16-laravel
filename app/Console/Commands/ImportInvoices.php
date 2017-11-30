<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:invoices';

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
        $this->info("This is import invoices");

        //  Initiate curl
        $ch = curl_init();
        $url="https://www.milletech.se/invoicing/export/";

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


        foreach($result as $invoice) {
            //Kolla om modellen redan finns via Customer::find($id). Om modellen inte finns så blir det null
            $this->info("Importing/update invoices: ".$invoice['id']);

        }
    }
}
