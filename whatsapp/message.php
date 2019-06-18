<?php declare(strict_types=1);

use GuzzleHttp\Client;
use Twilio\TwiML\MessagingResponse;

session_start();

require_once('../vendor/autoload.php');

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    $response = handlePost();
} else {
//    throw new HttpInvalidParamException('POST ONLY PLEASE PEOPLES');
    echo getRandomImageUrl();
}

echo $response;

function getRandomImageUrl(): string
{
    $guzzle = new Client();
    $response = $guzzle->get('https://en.wikipedia.org/api/rest_v1/page/random/title');

    $page = $response->getHeader('Content-Location')[0];

    $title = str_replace(
        'https://en.wikipedia.org/api/rest_v1/page/title/',
        '',
        $page
    );
    $_SESSION['title'] = strtoupper($title);

    $page = str_replace('title', 'media', $page);

    $response = $guzzle->get($page);
    $response = json_decode((string)$response->getBody());
    return $response->items[0]->original->source;
}

function handlePost(): MessagingResponse
{
    $messagingResponse = new MessagingResponse();
    if (strtoupper($_POST['Body']) === 'PLAY') {
        $messagingResponse->message('')
            ->media(getRandomImageUrl());
        return $messagingResponse;
    }

    if(!isset($_SESSION['title']) || empty($_SESSION['title'])) {
        $messagingResponse->message('Please send the word PLAY to start a game');
        return $messagingResponse;
    }

    if(strstr($_SESSION['title'], strtoupper($_POST['Body']))) {
        $messagingResponse->message('YOU WIN, it was ' . $_SESSION['title']);
        unset($_SESSION['title']);
        return $messagingResponse;
    }

    $messagingResponse->message('YOU LOSE! It was ' . $_SESSION['title']);
    unset($_SESSION['title']);
    return $messagingResponse;
}