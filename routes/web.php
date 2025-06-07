<?php

use App\Http\Controllers\AiSEO;
use App\Http\Controllers\TweetDelete;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailerSend;
use App\Http\Controllers\SMSSend;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    phpinfo();
    return view('welcome');
});

//Route::post('/send_email', MailerSend::class);
Route::post('/send_brevo', [MailerSend::class, 'brevo']);
Route::post('/send_bulksms', [SMSSend::class, 'bulkSMS']);
Route::post('/send_mailjet', [MailerSend::class, 'mailjet']);
Route::post('/ai_seo', [AiSEO::class, 'get']);
Route::post('/generate_bulk', [AiSEO::class, 'bulk']);
Route::post('/generate_titles', [AiSEO::class, 'generate_titles']);
Route::post('/generate_content', [AiSEO::class, 'generate_content']);
Route::get('/delete-tweets/{username}', [TweetDelete::class, 'deleteTweets']);


Route::post('/demo', function () {
$message = request('message');
dd($message);
$OPENAI_API_KEY = env('OPENAI_API_KEY');
sleep(10);
    $client = new GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.openai.com/v1/chat/completions', [
        'headers' => [
            'User-Agent' => 'testing/1.0',
            'Accept'     => 'application/json',
            'X-Foo'      => ['Bar', 'Baz'],
            'Authorization' =>  "Bearer $OPENAI_API_KEY"
        ],
        'json' => [
            //"model" =>  "gpt-3.5-turbo",
            "model" =>  "gpt-4",
            "messages" => [["role" =>  "user", "content" => $message]]
        ]
    ]);

    $r = json_decode($response->getBody()->getContents());
    return $r->choices[0]->message->content;
    dd($client->res);
});
