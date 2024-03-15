<?php

include 'NorenRoutes.php';
require_once("vendor/autoload.php");
use WebSocket\Client as WebSocketClient;
use WebSocket\TimeoutException;

// Create a WebSocket client instance and establish the connection
$client = new WebSocketClient($websocketUrl);


$filePath = "Example/susertoken.txt";

// Read data from the file
$susertoken = file_get_contents($filePath);

try {
    // Send a message to the WebSocket server
    //For websocket login
    $client->send('{"uid":"ANNAPA","actid":"ANNAPA","source":"API","susertoken":"' . $susertoken . '","t":"c"}');

    //For sub feed
    $client->send('{"t":"t", "k":"NSE|22"}');

    // Receive and echo the response from the WebSocket server
    $message = $client->receive();
    echo $message . PHP_EOL;

    // Continuously receive and echo messages from the WebSocket server
    while (true) {
        try {
            $message = $client->receive();
            echo "Received data: $message" . PHP_EOL;
        } catch (TimeoutException $e) {
            continue; // Retry the receive operation
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
    // Handle other types of exceptions
}
?>
