<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GetWebPage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'get:webpage {url} {file_name}';
    protected $signature = 'import:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importerar kunder';

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
        //var_dump($url, $file);
    }
}
