<?php declare(strict_types=1);

use Twilio\TwiML\VoiceResponse;

require_once('./vendor/autoload.php');

$fromNo = $_GET['From'];
$voiceResponse = new VoiceResponse();

if (isset($_POST['Digits']) && $_POST['Digits'] == '1') {
    $voiceResponse->gather(['input' => 'dtmf', 'numDigits' => 1])
        ->say('Press 2 to continue');
} else if (isset($_POST['Digits']) && $_POST['Digits'] == '2') {
    $voiceResponse->enqueue('Streamtastic');
    $voiceResponse->record();
} else {
    $voiceResponse->gather(['input' => 'dtmf', 'numDigits' => 1])
        ->say('This call will be recorded. Press 1 to  continue.');
}

echo $voiceResponse;

/**
 * <Gather input="speech dtmf" timeout="3" numDigits="1">
 * <Say>Please press 1 or say sales for sales.</Say>
 * </Gather>
 */