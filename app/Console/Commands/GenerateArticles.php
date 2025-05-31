<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleRetry\GuzzleRetryMiddleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GenerateArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $signatures = 'generate-posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = File::files(public_path('blog_titles'));
        //$files = //json_decode(File::get(public_path('niches.json')), true);
//sleep(10);
                //$client = new GuzzleHttp\Client();
                $stack = HandlerStack::create();
                $stack->push(GuzzleRetryMiddleware::factory());
                $listener = function(int $attemptNumber, float $delay, RequestInterface &$request, array &$options, ?ResponseInterface $response) {
                    var_dump("");
                    echo sprintf(
                        "Retrying request to %s.  Server responded with %s.  Will wait %s seconds.  This is attempt #%s",
                        $request->getUri()->getPath(),
                        $response->getStatusCode(),
                        number_format($delay, 2),
                        $attemptNumber
                    );
                };
                $client = new Client([
                    'handler' => $stack,
                    'on_retry_callback' => $listener,
                    'max_retry_attempts' => 20,
                    'retry_on_status' => [
                        300,
                        301,
                        302,
                        303,
                        304,
                        305,
                        306,
                        307,
                        308,
                        309,
                        310,
                        311,
                        312,
                        313,
                        314,
                        315,
                        316,
                        317,
                        318,
                        319,
                        320,
                        321,
                        322,
                        323,
                        324,
                        325,
                        326,
                        327,
                        328,
                        329,
                        330,
                        331,
                        332,
                        333,
                        334,
                        335,
                        336,
                        337,
                        338,
                        339,
                        340,
                        341,
                        342,
                        343,
                        344,
                        345,
                        346,
                        347,
                        348,
                        349,
                        350,
                        351,
                        352,
                        353,
                        354,
                        355,
                        356,
                        357,
                        358,
                        359,
                        360,
                        361,
                        362,
                        363,
                        364,
                        365,
                        366,
                        367,
                        368,
                        369,
                        370,
                        371,
                        372,
                        373,
                        374,
                        375,
                        376,
                        377,
                        378,
                        379,
                        380,
                        381,
                        382,
                        383,
                        384,
                        385,
                        386,
                        387,
                        388,
                        389,
                        390,
                        391,
                        392,
                        393,
                        394,
                        395,
                        396,
                        397,
                        398,
                        399,
                        400,
                        401,
                        402,
                        403,
                        404,
                        405,
                        406,
                        407,
                        408,
                        409,
                        410,
                        411,
                        412,
                        413,
                        414,
                        415,
                        416,
                        417,
                        418,
                        419,
                        420,
                        421,
                        422,
                        423,
                        424,
                        425,
                        426,
                        427,
                        428,
                        429,
                        430,
                        431,
                        432,
                        433,
                        434,
                        435,
                        436,
                        437,
                        438,
                        439,
                        440,
                        441,
                        442,
                        443,
                        444,
                        445,
                        446,
                        447,
                        448,
                        449,
                        450,
                        451,
                        452,
                        453,
                        454,
                        455,
                        456,
                        457,
                        458,
                        459,
                        460,
                        461,
                        462,
                        463,
                        464,
                        465,
                        466,
                        467,
                        468,
                        469,
                        470,
                        471,
                        472,
                        473,
                        474,
                        475,
                        476,
                        477,
                        478,
                        479,
                        480,
                        481,
                        482,
                        483,
                        484,
                        485,
                        486,
                        487,
                        488,
                        489,
                        490,
                        491,
                        492,
                        493,
                        494,
                        495,
                        496,
                        497,
                        498,
                        499,
                        500,
                        501,
                        502,
                        503,
                        504,
                        505,
                        506,
                        507,
                        508,
                        509,
                        510,
                        511,
                        512,
                        513,
                        514,
                        515,
                        516,
                        517,
                        518,
                        519,
                        520,
                        521,
                        522,
                        523,
                        524,
                        525,
                        526,
                        527,
                        528,
                        529,
                        530,
                        531,
                        532,
                        533,
                        534,
                        535,
                        536,
                        537,
                        538,
                        539,
                        540,
                        541,
                        542,
                        543,
                        544,
                        545,
                        546,
                        547,
                        548,
                        549,
                        550,
                        551,
                        552,
                        553,
                        554,
                        555,
                        556,
                        557,
                        558,
                        559,
                        560,
                        561,
                        562,
                        563,
                        564,
                        565,
                        566,
                        567,
                        568,
                        569,
                        570,
                        571,
                        572,
                        573,
                        574,
                        575,
                        576,
                        577,
                        578,
                        579,
                        580,
                        581,
                        582,
                        583,
                        584,
                        585,
                        586,
                        587,
                        588,
                        589,
                        590,
                        591,
                        592,
                        593,
                        594,
                        595,
                        596,
                        597,
                        598,
                        599],
                    'default_retry_multiplier' => 10
                ]);
                //dd($client);
                for ($i = 0; count($files) > $i; $i++) {
                    $file = $files[$i];
                    $path = $file->getPathname();
                    $niche_name = $file->getBasename();
                    //dd($niche_name);
                    if ($niche_name) {
                        $exploded = explode('.json', $niche_name)[0];
                        $niche_slug = $exploded;
                        $niche_name = str_replace('_', ' and ', $exploded);
                    }
                    $title_list = get_titles($path);
                    create_post($title_list, $niche_name, $client);
                }



    }
}

function create_post($title_list, $niche_name, $client) {
    //dd([$title_list, $niche_name]);
    collect($title_list)->each(function ($titles, $category_name) use ($niche_name, $client) {
        if($titles){
           // for ($i = 0; count($titles) > $i; $i++) {
                //$title = $titles[$i];
                $title = $titles;
                //dd([$title, $niche_name]);
            $url = "https://fast.loc/?rest_route=/gpt-post-maker/v1/post_exists/";
            $posts_exists = go($url, 'POST', $client, ['title' => $title]);
                //dd($posts_exists === 'false');
                if ($posts_exists === 'false') {
                    //$content = get_demo_content();
                    $content = get_content($category_name, $niche_name, $title, $client);
                    //dd($content);
                    create_post_on_wp($title, $category_name, $niche_name, $content, $client);
                } else {
                    var_dump($title);
                    var_dump("Post exist...skip");
                }
            //}
        }
    });

    // dd($titles);
}

function get_demo_content() {
    return "Are you a beginner looking to learn some makeup tricks and tips? Then you've come to the right place! We've put together a list of the top 10 best makeup tutorials for beginners that cover everything from foundation to eye makeup. Let's dive in!

1. Foundation for Beginners
The first step in creating a flawless makeup look is to get the base right. This video will guide you through the process of selecting the right foundation for your skin type, and how to correctly apply it for a natural-looking finish.

2. Contouring for Beginners
Contouring is a great way to define your features and create a sculpted look. This beginner's tutorial will show you how to get started with contouring, using a few basic products.

3. Eyeliner for Beginners
Mastering eyeliner can be tricky, but with the right techniques and tools, anyone can do it! This tutorial will show you how to apply eyeliner for different looks, from a subtle line to a dramatic wing.

4. Natural Everyday Makeup
If you're looking for an easy everyday makeup routine, this tutorial is perfect for you. It features natural tones and techniques that will enhance your features without being too bold.

5. Bold Lip Makeup
If you're feeling daring and want to try a bold lip, this tutorial has got you covered. Learn how to choose the right shade for your skin tone, and how to apply it for a long-lasting finish.

6. Smokey Eye for Beginners
Smokey eyes are a classic makeup look that never goes out of style. In this tutorial, you'll learn how to create a smokey eye using just a few basic products.

7. Natural Eyebrow Tutorial
Well-groomed eyebrows can make a huge difference in your overall look. This tutorial will show you how to shape and fill in your eyebrows for a natural, flattering finish.

8. Highlighter for Beginners
Highlighter is perfect for adding a subtle glow to your face. This tutorial will show you how to apply highlighter to enhance your features and give you a healthy glow.

9. Beginner's Eye Makeup
If you're new to eye makeup, this tutorial will guide you through the basics. You'll learn how to apply eyeshadow, mascara, and eyeliner to create a simple but stunning look.

10. Back to Basics Makeup Tutorial
This comprehensive tutorial covers everything from skincare to the final touches of your makeup. It includes tips and tricks for all skin types and covers every aspect of makeup application for beginners.

In conclusion, these makeup tutorials cover all the basics for beginners to help them achieve their desired makeup look. Whether you're looking for everyday makeup or a bold look for a special occasion, these tutorials will guide you through the process step by ste
p. Pin this article for future reference and keep practicing! You'll soon become a pro with these tutorials.\"";

}


function get_content($category, $niche, $title, $client) {
    $retry_count = 0;
    $OPENAI_API_KEY = env('OPENAI_API');
    //dd([$niche, $title]);
    $text = "Write an SEO optimized blog post on a ${niche} blog titled: $title. Generate a unique [2-word or 3 word] keyword. Put the keyword on a separate, opening line. Spread the keyword at least 4 times within the post and once in the opening paragraph, wrapped in <strong> and <i> html tags Create two sub-headings and wrap each in an <h2> HTML tag. The tone of the post should be upbeat, fun and generally positive. Include at least one relevant wikipedia page link and one other relevant webmd post";
    //$text = "Write an SEO optimized post on a ${niche} blog, titled '${title}'. Generate a UNIQUE [3-words or more] keyword and wrap it in a <strong> and <i> html tag. Spread the keyword at least 6 times across the post and once in the opening paragraph. Wrap each sub-heading in an <h2> HTML tag. The tone of the post should be upbeat, fun and generally positive. Assume the readers are generally familliar with the keyword, so skip the introduction. Include at least one relevant wikipedia page link in an html <a> tag.";
    //$text = "Imagine you are running a fitness/anabolic focused blog, write an SEO optimized, 800 words or more article on '$title' .Wrap each new section sub-topic in h2 tags";


    //dd($text);
    $result = false;
    //$response = $client->request('POST', 'https://digest.loc/?rest_route=/gpt-post-maker/v1/create_post', [
    do {
        try {
            var_dump($title);
            sleep(5);
            $response = $client->request('POST', 'https://api.openai.com/v1/chat/completions', [
                'verify' => false,
                'headers' => [
                    'User-Agent' => 'testing/1.0',
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer $OPENAI_API_KEY"
                ],
                'json' => [
                    "model" => "gpt-4-0613",
                    "messages" => [["role" => "user", "content" => $text]]
                ],
            ]);
            $r = json_decode($response->getBody()->getContents());
            $result = $r->choices[0]->message->content;
            //dd($result);
            //var_dump($result);
            return $result;
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            // log the error here

            /*Log::Warning('guzzle_connect_exception', [
                'message' => $e->getMessage()
            ]);*/
            var_dump($e->getMessage());
        } catch (\GuzzleHttp\Exception\RequestException $e) {

            var_dump($e->getMessage());
        }
        if (++$retry_count == 100) {
            break;
        }else{
            var_dump("retrying...");
        }
    } while (!is_string($result));
}

function create_post_on_wp($title, $category, $niche_name, $content, $client) {

    $url = "https://fast.loc/?rest_route=/gpt-post-maker/v1/create_post/";
    //dd($url);

    $r = go($url, 'POST',$client,[
        'title' => $title,
        'niche' => $niche_name,
        'content' => $content,
        'category' => $niche_name,
    ]);
    var_dump( $r,);
}

function go($url, $action, $client, $data){
    $response = $client->request($action, $url, [
        'verify' => false,
        'headers' => [
            'User-Agent' => 'testing/1.0',
            'Accept' => 'application/json',
        ],
        'form_params' => $data
    ]);
    return $response->getBody()->getContents();
}
function get_titles($path) {
    return json_decode(File::get($path), true);
}

function run_demo() {
    return [
        "How Anime Has Influenced My Life and Career",
        "The Fascinating World of Anime Merchandise",
        "Exploring the Themes of Death and the Afterlife in Anime",
        "Anime's Impact on Pop Culture: A Look Back and Ahead",
        "The Art of Anime: From Sketch to Screen"
    ];

}

function run($client, $message, $key) {
    //dd([$message]);
    $response = $client->request('POST', 'https://api.openai.com/v1/chat/completions', [
        'verify' => false,
        'headers' => [
            'User-Agent' => 'testing/1.0',
            'Accept' => 'application/json',
            'Authorization' => "Bearer $key"
        ],
        'json' => [
            "model" => "gpt-3.5-turbo",
            "messages" => [["role" => "user", "content" => "Give me 110 unique blog posts titles on '$message'. Put the list in string json array. Remove the number at the beginning of each line"]]
        ]
    ]);

    $r = json_decode($response->getBody()->getContents());
    $result = $r->choices[0]->message->content;
    var_dump($message);
    var_dump(strlen($result));
    var_dump(substr($result, 0, 20));
    return json_decode($result);
}

function append_to_file($result, $niche_name, $category) {
    $path = public_path('blog_titles/');
    $path_name = "$path/$niche_name.json";
    if (!File::isDirectory($path)) {
        File::makeDirectory($path, 0777, true, true);
    }
    if (File::exists($path_name)) {
        $file_content = json_decode(File::get($path_name), true);
    } else {
        $file_content = [];
    }
    $file_content[$category] = $result;

    File::put($path_name, json_encode($file_content));
    //dd($path);
    //dd([$niche_name, $category, $result]);
}
