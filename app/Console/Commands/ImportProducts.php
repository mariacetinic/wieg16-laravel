<?php

namespace App\Console\Commands;

use App\Group;
use App\GroupPrice;
use App\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'get:products {url} {file_name}';
    protected $signature = 'import:products';

    /**
     * The console command description.
     *
     * @var string
     */
    //protected $description = 'Hämtar data och sparar i en fil';
    protected $description = 'Importera produkter';

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
        /*$url = $this->argument('url');
        $file = $this->argument('file_name');

        $this->info("Initializing curl..."); //efter det nedan från $curl skrivs this)delar upp stegen som kommandot tar
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, 0); //vi vill inte ha nån header respons, bara innehållet
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // curl ska skicka tillbaka responsen via curl exec och lagrar responsen i en variabel (se nedan)
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // curl ska följa omdirigeringar

        $this->info("Sending request to: ".$url);
        $response = curl_exec($curl); //innehållet blir responsen
        Storage::put($file, $response);
        $this->info("File stored at: ".$file);
        //var_dump($url, $file);*/

        $this->info("Import products: ");
        //  Initiate curl
        $ch = curl_init();
        $url = ("https://www.milletech.se/invoicing/export/products");
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

        foreach ($result['products'] as $product) {
            $this->info("Importerar produkter " . $product['entity_id']);

            $dbProduct = Product::findOrNew($product['entity_id']);
            //Spara med $customer->save()
            $dbProduct->fill($product)->save();

            if (isset($product['group_prices']) && is_array($product['group_prices'])) {
                $group_prices = GroupPrice::findOrNew($product['group_prices']['group_id']);
                $group_prices->fill($product['group_prices']);
                $group_prices->save();
            }


            //kollar först att group_prices är satt och att det är en array, sedan görs en foreach
            //när du gör en foreach så flyttar du dig ett steg ner så att säga
            foreach ($product['group_prices'] as $gp){
                $dbGroup = GroupPrice::findOrNew($gp['group_id']);
                //Spara med $customer->save()
                $dbGroup->fill($gp)->save();
            }

        }

        foreach($result['groups'] as $group) {

            $dbGroup = Group::findOrNew($group['customer_group_id']);
            //Spara med $customer->save()
            $dbGroup->fill($group)->save();


        }



    }
}


/*if (isset($product['groups']) && is_array($product['groups'])) {
    $products = Product::findOrNew($product['groups']['customer_group_id']);
    $products->fill($product['groups']);
    $products->save();
}*/