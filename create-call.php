<?php declare(strict_types=1);

use Twilio\Rest\Client;

require_once('./vendor/autoload.php');

$sid = "ACb877821242bbaedc246328ca0a8c3fc6";
$token = getenv("TWILIO_TOKEN");

$client = new Client($sid, $token);

$call = $client->calls
    ->create(getenv("MY_PHONE_NUMBER"), // to
        "+447588740453", // from
        ["url" => "http://geeh.ngrok.io/response.xml"]
    );

var_dump($call);