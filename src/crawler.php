<?php

require 'vendor/autoload.php';
require 'src/DomCrawler.php';

use DomCrawler\Crawler\DomCrawler;
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

$crawler = new Crawler();

$domCrawler = new DomCrawler($client, $crawler);
$trackedElements = $domCrawler->crawl($url, $element);

foreach ($trackedElements as $element) {
  echo $element . PHP_EOL;
}
