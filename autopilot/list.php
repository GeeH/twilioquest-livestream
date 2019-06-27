<?php declare(strict_types=1);

require_once('../vendor/autoload.php');

$response =  new \Twilio\TwiML\VoiceResponse();
$response->say('I don\'t have any appointments available');

echo $response;
