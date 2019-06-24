<?php declare(strict_types=1);

use App\SafeToken;
use Twilio\Rest\Client;

require_once('../vendor/autoload.php');

$sid = "ACb877821242bbaedc246328ca0a8c3fc6";
$token = new SafeToken(getenv("TWILIO_TOKEN"));

$client = new Client($sid, $token);

//$client->video->rooms->create(['name' => 'TQ Stream of Hope']);

var_dump(
    $client->video->rooms->read()[0]->uniqueName
);