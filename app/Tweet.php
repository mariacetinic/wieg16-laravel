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

