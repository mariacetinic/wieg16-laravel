<?php

namespace App\Console\Commands;

use App\InstagramPicture;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportInstagramPictures extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:instagrampictures {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importera bilder från instagram';

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

        $url = $this->argument('url');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 111f431e-d78e-c002-b05b-242252cbc3a3"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $result = json_decode($response, true);

        foreach($result['data'] as $instagramId) {
            $this->info("Importing/update instagrampictures with id: " . $instagramId['id']);

            //
            $dbInstagramId = InstagramPicture::findOrNew($instagramId['id']);
            $dbInstagramId->fill([
                'id' => $instagramId['id'],
                'url' => $instagramId['images']['standard_resolution']['url']
            ])->save();


            /*
            $dbInstagramPicture = InstagramPicture::findOrNew($instagrampics['images']['standard_resolution']['url']);
            $dbInstagramPicture->fill($instagrampics)->save();
            */

        }

    }
}
