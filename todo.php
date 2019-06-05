<?php declare(strict_types=1);

use Twilio\TwiML\MessagingResponse;

require_once('./vendor/autoload.php');
$filename = __DIR__ . '/todo.json';

$todos = getTodoList($filename);

$body = $_GET['Body'];

$explodedBody = explode(" ", $body);
$command = strtolower(array_shift($explodedBody));
$item = implode(" ", $explodedBody);

$messagingResponse = handleCommand($command, $item, $todos);

putTodoList($filename, $todos);

echo $messagingResponse;

function handleCommand(string $command, string $item, array &$todos): MessagingResponse
{
    $messagingResponse = new MessagingResponse();

    if ($command === "add") {
        $todos = addTodo($todos, $item);
        $messagingResponse->message("Added: {$item}");
        return $messagingResponse;
    }

    if ($command === "list") {
        $message = "";
        foreach ($todos as $key => $todo) {
            $message .= $key + 1 . ". " . $todo . " ";
        }

        $messagingResponse->message(
            $message,
            ['action' => 'http://geeh.ngrok.io/status.php']
        );
        return $messagingResponse;
    }

    if ($command === "remove") {
        unset($todos[$item - 1]);
        $todos = array_values($todos);

        $messagingResponse->message("Removed item: {$item}");
        return $messagingResponse;
    }

}

function addTodo(array $todos, string $newTodo): array
{
    $todos[] = $newTodo;
    return $todos;
}

function getTodoList(string $filename): array
{
    if (!file_exists($filename)) {
        return [];
    }
    return json_decode(file_get_contents($filename), true);
}

function putTodoList(string $filename, array $todos): void
{
    file_put_contents($filename, json_encode($todos));
}
