<?php


namespace App\Http\Controllers;


use Abraham\TwitterOAuth\TwitterOAuth;

class TweetDelete{

    protected $connection;

    public function __construct(){
        $this->connection = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET_KEY'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET')
        );
    }

    public function deleteTweets($username)
    {
        // Fetch tweets
        $tweets = $this->connection->get("statuses/user_timeline", [
            "screen_name" => $username,
            "count" => 200,
            "tweet_mode" => "extended" // Ensures full text is retrieved for tweets
        ]);

        // Check for errors in response
        if ($this->connection->getLastHttpCode() != 200) {
            dd("Error: " . $this->connection->getLastBody());
        }

        // Print fetched tweets for debugging
        dd($tweets);

        foreach ($tweets as $tweet) {
            if (isset($tweet->id_str)) {
                $result = $this->connection->post("statuses/destroy/{$tweet->id_str}");
                if ($this->connection->getLastHttpCode() == 200) {
                    echo "Deleted tweet ID: {$tweet->id_str}\n";
                } else {
                    echo "Failed to delete tweet ID: {$tweet->id_str}\n";
                }
                sleep(1); // Sleep for a second to respect rate limits
            }
        }
    }

}
