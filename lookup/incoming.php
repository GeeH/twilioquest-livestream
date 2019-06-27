<?php declare(strict_types=1);

use Twilio\Rest\Client;

require_once('../vendor/autoload.php');

$sid = "ACb877821242bbaedc246328ca0a8c3fc6";
$token = new \App\SafeToken(getenv("TWILIO_TOKEN"));

$client = new Client($sid, $token);

$number = $_GET['From'];

$result = $client->lookups
    ->phoneNumbers($number)->fetch(['AddOns' => 'marchex_cleancall']);

$client->messages->create('whatever');

$pass = $result->addOns['results']['marchex_cleancall']['result']['result']['recommendation']
    === "PASS";

$voiceResponse = new \Twilio\TwiML\VoiceResponse();
if($pass) {
    $voiceResponse->dial("+447492371993");
} else {
    $voiceResponse->say("Go away you no good spam caller");
}

echo $voiceResponse;