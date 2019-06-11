<?php declare(strict_types=1);

use Twilio\TwiML\VoiceResponse;

require_once('./vendor/autoload.php');

$voiceResponse = new VoiceResponse();

$fromNo = $_GET['From'];
$whiteList = ['+15017250604', '+447446188852'];

if (in_array($fromNo, $whiteList, true)) {
    $attributes = ['startConferenceOnEnter' => false];
    if ($fromNo === "+447446188852") {
        $attributes['startConferenceOnEnter'] = true;
    }
    $voiceResponse->dial()->conference('Spabby', $attributes);
} else {
    $voiceResponse->hangup();
}

echo $voiceResponse;






