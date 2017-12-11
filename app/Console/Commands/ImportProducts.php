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
    protected $signature = 'import:products {file_name}';

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
        $file = $this->argument('file_name');
        $storage = Storage::get($file);
        $result = json_decode($storage, true);

        foreach ($result['groups'] as $group) {
            $groups = Group::findOrNew($group['customer_group_id']);
            $groups->fill($group);
            $groups->save();
        }

        foreach ($result['products'] as $product) {
            $this->info("Importerar produkter " . $product['entity_id']);
            $products = Product::findOrNew($product['entity_id']);

            if (isset($product['stock_item']) && is_array($product['stock_item'])) {
                $product['stock_item'] = array_shift($product['stock_item']);
            }
            $products->fill($product);
            $products->save();

            foreach ($product['group_prices'] as $group_price) {
                $group_prices = GroupPrice::findOrNew($group_price['price_id']);
                $group_price['product_id'] = $product['entity_id'];
                $group_prices->fill($group_price);
                $group_prices->save();
            }
        }
    }
}



/*if (isset($product['groups']) && is_array($product['groups'])) {
    $products = Product::findOrNew($product['groups']['customer_group_id']);
    $products->fill($product['groups']);
    $products->save();
}*/