<?php declare(strict_types=1);

use App\SafeToken;
use Twilio\Rest\Client;

require_once('./vendor/autoload.php');

$toNumber = "+447446188852";
$fromNumber = "+18779601539";

$sid = "ACb877821242bbaedc246328ca0a8c3fc6";
$token = new SafeToken(getenv("TWILIO_TOKEN"));

$client = new Client($sid, $token);

$message = "This is message ";

for ($i = 1; $i < 11; $i++) {
    $response = $client->messages->create(
        $toNumber,
        [
            "from" => $fromNumber,
            "body" => $message . $i,
        ]
    );
}

var_dump($response);

