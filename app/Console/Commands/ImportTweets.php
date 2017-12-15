<?php

namespace App\Console\Commands;

use App\Tweet;
use Illuminate\Console\Command;

class ImportTweets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tweets {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing tweets from twitter';

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
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.twitter.com/1.1/search/tweets.json?q=metoo",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer AAAAAAAAAAAAAAAAAAAAANir3QAAAAAAo7mISs5vYWnPmQP%2B7%2BQRS4AMbns%3DFlJtPgu1uCZm1GUkc2kd7kx76fzOF09EJbYtNdcVNd8MoUONol",
                "cache-control: no-cache",
                "postman-token: 20e19297-fb10-b938-02cd-c07cb41b960d"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $result = json_decode($response, true);

        foreach($result['statuses'] as $tweet) {
            $this->info("Importing/update tweets with id: " . $tweet['id']);
            //
            var_dump($tweet['text']);
            $dbTweet = Tweet::findOrNew($tweet['id']);

            $dbTweet->fill([
                'id' => $tweet['id'],
                'text' => $tweet['text']
            ])->save();

        }

    }
}
