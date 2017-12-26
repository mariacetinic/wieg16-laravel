<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;

class TweetsController extends Controller
{
    public function index()
    {
        return View('tweets/index', ['tweets' => Tweet::All()]);
    }


    public function callTweetCount()
    {
        $tweets = Tweet::all();
        echo Tweet::countWords($tweets);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function countAndSort(Request $request)
    {
        $countTweets = Tweet::getTweets($request->twittertoken, $request->word);

        $countedAndSorted = Tweet::countAndSort($countTweets);

        return View('tweets/index', ['words' => $countedAndSorted]);
    }
}
