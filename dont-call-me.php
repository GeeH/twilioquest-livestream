<?php declare(strict_types=1);

use App\SafeToken;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;

require_once('./vendor/autoload.php');

// Input filtering here /+[\d]*
$fromNo = $_GET['From'];

$protectedNo = '+MYNO';
$filename = __DIR__ . '/blocked.json';

// Part One
$voiceResponse = new VoiceResponse();
$voiceResponse->say("There waiting for you Gordon. Down in the test chamber");
echo $voiceResponse;

// Part Two
// Queue This
$sid = "ACb877821242bbaedc246328ca0a8c3fc6";
$token = new SafeToken(getenv("TWILIO_TOKEN"));
$client = new Client($sid, $token);

$message = 'I hate phonecalls. Please Tweet me @GeeH if it\'s important.';
$client->messages->create($fromNo, [
    'from' => $protectedNo,
    'body' => $message,
]);

// Part Three
$count = getNumberOfBlockedCalls($filename);
$count++;
putNumberOfBlockedCalls($filename, $count);

$message = 'You received a call from ' . $fromNo . '. I\'ve blocked ' . $count . ' calls so far.';
$client->messages->create($fromNo, [
    'from' => $protectedNo,
    'body' => $message,
]);

/**
 * 1. All incoming phone calls must be <Hangup>'d - though you're allowed to have fun with the caller before you hang up.
 * 2. After that, callers should receive a text message with instructions on other ways to contact your user
 *       (e.g. text, email, web chat).
 * 3. Finally, for every rejected call you should send a text message to your user
 *       telling them about it and include a count of the total number of phone calls you've saved them from.
 */

// Make persistence better
function getNumberOfBlockedCalls(string $filename): int
{
    if (!file_exists($filename)) {
        return 0;
    }
    return (int) json_decode(file_get_contents($filename));
}

function putNumberOfBlockedCalls(string $filename, int $count): void
{
    file_put_contents($filename, json_encode($count));
}