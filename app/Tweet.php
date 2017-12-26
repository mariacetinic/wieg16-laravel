<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tweets';

    // vitlista kolumner
    protected $fillable = [
        'id',
        'text'
    ];

    public $incrementing = false;
    public $timestamps = true;

    /**
     * @param $all
     */
    static public function countWords ($all)
    {
        $tweets = $all->pluck('text');
        $string = json_encode($tweets);
        $arr = explode(" ", $string);
        $doNotCount = [
            "metoo"
        ];

        $noDouble = array_unique($arr);
        $words = array_diff($doNotCount, $noDouble);
        foreach ($words as $word) {
            $count = substr_count($string, $word);
        }

    }

    static public function getTweets ($token, $word) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.twitter.com/1.1/search/tweets.json?q='.$word'",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".$token,
                "cache-control: no-cache",
                "postman-token: 20e19297-fb10-b938-02cd-c07cb41b960d"
            ),
        ));
        $response = json_decode(curl_exec($curl), true);
        $clean = [];
        foreach ($response['statuses'] as $data) {
            $clean[] = $data['text'];
        }
        return $clean;
    }

    static public function countAndSort ($tweets) {

        $supArr = [];

        foreach ($tweets as $tweet) {
            $exploded = explode (" ", $tweet);
            $supArr = array_merge($supArr, $exploded);
        }

        $countedTweets = array_count_values($supArr);
        arsort($countedTweets);

        return $countedTweets;

    }

}


//Modellen gör funktionen, som du sedan anropar i controllern. I din web.php så visar den upp vad controllern gör

