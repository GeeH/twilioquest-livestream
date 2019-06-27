<?php declare(strict_types=1);

require_once('../vendor/autoload.php');

$filename = __DIR__ . '/appointments.json';

//$data = json_decode($_POST['Memory']);
$data = json_decode('{"twilio":{"voice":{"To":"","From":"client:Anonymous","CallSid":"CA8191d78cd7e16f50a14769d2ddc70c86","Direction":"inbound"},"collected_data":{"appointment_details":{"answers":{"collect_date":{"answer":"2019-07-01","filled":true,"type":"Twilio.DATE","confirmed":false,"attempts":1},"collect_time":{"answer":"16:00","type":"Twilio.TIME","filled":true,"attempts":1,"confirmed":false}},"date_completed":"2019-06-24T10:48:11Z","date_started":"2019-06-24T10:48:00Z","status":"complete"}}}}');

$date = $data->twilio->collected_data->appointment_details->answers->collect_date->answer;
$time = $data->twilio->collected_data->appointment_details->answers->collect_time->answer;

$appointments = getAppointments($filename);

if (isset($appointments[$date][$time])) {
    // throw back to autopilot to ask for different date/time
} else {
    // add the appointment
}


function getAppointments(string $filename): array
{
    if (!file_exists($filename)) {
        return [];
    }
    return json_decode(file_get_contents($filename), true);
}

function putAppointments(string $filename, array $appointments): void
{
    file_put_contents($filename, json_encode($appointments));
}