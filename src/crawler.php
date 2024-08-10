<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();
$url = $_ENV['TRACKING_URL'];
$element = $_ENV['TRACKING_ELEMENT'];

$client = new Client([
  'curl' => [
      CURLOPT_SSL_VERIFYPEER => false,
  ],
]);

$response = $client->request('GET', $url);

$html = $response->getBody();

$crawler = new Crawler();
$crawler->addHtmlContent($html);

$elements = $crawler->filter($element);

foreach ($elements as $element) {
  echo $element->textContent . PHP_EOL;
}
