<?php declare(strict_types=1);

use Twilio\Rest\Client;

require_once('../vendor/autoload.php');

$sid = "ACb877821242bbaedc246328ca0a8c3fc6";
$token = new \App\SafeToken(getenv("TWILIO_TOKEN"));

$client = new Client($sid, $token);

/** @var string[] $numbers */
$numbers = [
//    '+551155256325',
//    '+493019449',
//    '+4915735982887',
//    '+496979550',
//    '+493022610',
//    '+498969931333',
//    '+443432221234',
//    '+4916793929939',
//    '+17189237300',
//    '+4915735997026​',
//    '+13123133187',
//    '+12092104311',
//    '+16513219277',
//    '+14255288365',
//    '+61481073056',
//    '+17864755228',
    '+35314819352'
];

foreach ($numbers as $number) {
    try {
        $result = $client->lookups
            ->phoneNumbers($number)->fetch(['AddOns' => 'whitepages_pro_caller_id']);

        var_dump($result->addOns['results']['whitepages_pro_caller_id']);
    } catch (\Twilio\Exceptions\RestException $e) {
        echo "Bad $number <BR>";
    }
}

