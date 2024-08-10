<?php

use GuzzleHttp\Client;

$client = new Client();
$response = $client->request('GET', $_ENV['TRACKING_URL']);

$html = $response->getBody();
