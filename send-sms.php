<?php declare(strict_types=1);

require_once('./vendor/autoload.php');

$toNumbers = ["+447446188852", "+MYNO"];

$messagingServiceSid = "MGde4e7049022f101cc5d2a5eb19e8d5d0";
$sid = "ACb877821242bbaedc246328ca0a8c3fc6";
$token = getenv("TWILIO_TOKEN");

$time = time();
$message = "Hi.";

foreach ($toNumbers as $toNumber) {
    for ($i = 0; $i < 10; $i++) {
        $response = $client->messages->create(
            $toNumber,
            [
                "messagingServiceSid" => $messagingServiceSid,
                "body" => $message,
            ]
        );
    }
}

var_dump($response);

