<?php

namespace Andrew\DomCrawler;

use GuzzleHttp\ClientInterface;

class DomCrawler
{
  private $httpClient;
  private $crawler;

  public function __construct(ClientInterface $httpClient, $crawler)
  {
    $this->httpClient = $httpClient;
    $this->crawler = $crawler;
  }

  public function crawl(string $url, string $elementToCrawl): array
  {
    $response = $this->httpClient->request('GET', $url);

    $html = $response->getBody();
    $this->crawler->addHtmlContent($html);

    $tracked = $this->crawler->filter($elementToCrawl);
    $elements = [];

    foreach ($tracked as $element) {
      $elements[] = $element->textContent;
    }

    return $elements;
  }
}
