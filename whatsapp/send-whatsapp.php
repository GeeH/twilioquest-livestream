<?php declare(strict_types=1);

use App\SafeToken;
use Twilio\Rest\Client;

require_once('../vendor/autoload.php');

$toNumber = "whatsapp:+447446188852";
$fromNumber = "whatsapp:+14155238886";

$sid = "ACb877821242bbaedc246328ca0a8c3fc6";
$token = new SafeToken(getenv("TWILIO_TOKEN"));

$client = new Client($sid, $token);

$message = "I sent an image";

$result = $client->messages->create(
    $toNumber,
    [
        'from' => $fromNumber,
        'body' => $message,
        'MediaUrl' => 'https://juststickers.in/wp-content/uploads/2017/04/dont-panic.png',
    ],
);
var_dump($result);