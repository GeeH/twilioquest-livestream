<?php declare(strict_types=1);

use Twilio\Rest\Client;

require_once('vendor/autoload.php');

$myNumber = '+4412345677';

$client = new Client('ACb877821242bbaedc246328ca0a8c3fc6',
    getenv('TWILIO_TOKEN'));

$numbers = $client->messages
    ->read(['to' => '+447480736685']);

var_dump($numbers);

$sent = [];
foreach($numbers as $number) {
    if(!in_array($number->from, $sent)) {
        $sent[] = $number->from;
//        $client->calls->create($number->from, $myNumber, ['url' => 'http://']);
        var_dump("Dialed {$number->from} {$number->dateSent->}");
    }
}