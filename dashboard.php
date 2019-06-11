<?php declare(strict_types=1);

use Twilio\Rest\Client;

require_once('./vendor/autoload.php');

$sid = "ACb877821242bbaedc246328ca0a8c3fc6";
$token = new \App\SafeToken(getenv("TWILIO_TOKEN"));

$client = new Client($sid, $token);

$records = $client->usage->records->allTime->read();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
<table border="1">
    <thead>
    <tr>
        <th>Service</th>
        <th>Count</th>
        <th>Cost</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($records as $record): ?>
    <tr>
        <td><?= $record->description; ?></td>
        <td><?= $record->count; ?></td>
        <td>$<?= $record->price; ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
