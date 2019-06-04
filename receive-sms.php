<?php declare(strict_types=1);

require_once('./vendor/autoload.php');

use Twilio\TwiML\MessagingResponse;

$fromCountry = $_POST["FromCountry"];
$message = "Hi! It looks like your phone number was born in {$fromCountry}";

$messagingResponse = new MessagingResponse();
$messagingResponse->message($message);

echo $messagingResponse;