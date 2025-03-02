<?php

declare(strict_types=1);

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

function render_template(string $template, array $data = [])
{
  extract($data);
  require "templates/$template.php";
}


function translate_text(string $text, string $to): string
{
  $subscriptionKey = $_ENV["SUBSCRIPTION_KEY"];
  $endpoint = $_ENV["API_ENDPOINT"] . "&to=$to";

  $requestBody = [
    [
      'Text' => $text,
    ],
  ];

  $options = [
    'http' => [
      'header' => [
        'Content-type: application/json',
        'Ocp-Apim-Subscription-Key: ' . $subscriptionKey,
        'Ocp-Apim-Subscription-Region: eastus',
      ],
      'method' => 'POST',
      'content' => json_encode($requestBody),
    ],
  ];

  $context = stream_context_create($options);

  $response = file_get_contents($endpoint, false, $context);

  if ($response === FALSE) {
    return $text;
  }

  $responseData = json_decode($response, true);
  $translatedText = $responseData[0]['translations'][0]['text'];

  return $translatedText;
}
