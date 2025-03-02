<?php

declare(strict_types=1);
require_once 'lib/functions.php';

class NextMovie
{
  public function __construct(
    private string $title,
    private string $poster_url,
    private string $overview,
    private int $days_until,
    private string $release_date,
    private array $following_production
  ) {}

  static function fetch_and_create(string $api_url)
  {
    $response = file_get_contents($api_url);
    $data = json_decode($response, true);
    $translated_overview = translate_text($data["overview"], 'es');

    return new self(
      $data["title"],
      $data["poster_url"],
      $translated_overview,
      $data["days_until"],
      $data["release_date"],
      [
        "title" => $data["following_production"]["title"],
        "release_date" => $data["following_production"]["release_date"]
      ],
    );
  }

  function get_days_until(): string
  {
    $days = $this->days_until;

    return match (true) {
      $days === 0 => "Se estrena hoy",
      $days === 1 => "Se estrena mañana",
      $days === 7 => "Se estrena esta semana",
      $days === 30 => "Se estrena este mes",
      default => "Se estrena en $days días"
    };
  }

  function get_data()
  {
    return get_object_vars($this);
  }
}
