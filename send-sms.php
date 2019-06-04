<?php declare(strict_types=1);

use Twilio\Rest\Client;

require_once ('./vendor/autoload.php');

$toNumber = "+447481360673";
$fromNumber = "+447480736685";
$sid = 'ACb877821242bbaedc246328ca0a8c3fc6';
$token = getenv("TWILIO_TOKEN");


$time = time();
$message = "Greetings! The current time is: {$time} FT8CVCBTF01PFKN";

$client = new Client($sid, $token);

$response = $client->messages->create(
    $toNumber,
    [
        "from" => $fromNumber,
        "body" => $message,
    ]
);

var_dump($response);

