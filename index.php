<?php
const API_URL = 'https://whenisthenextmcufilm.com/api';

$context = stream_context_create([
  "ssl" => [
    "verify_peer" => false,
    "verify_peer_name" => false,
  ]
]);

$response = file_get_contents(API_URL, false, $context);
$data = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  <title>Next movie</title>
  <style>
    main {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin-top: 2rem;
    }

    section {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    p {
      max-width: 500px;
    }

    img {
      border-radius: 0.5rem;
    }

    h1 {
      margin-top: 0;
    }
  </style>
</head>

<body>
  <main>
    <section>
      <img
        src="<?= $data["poster_url"]; ?>"
        alt="<?= $data["title"]; ?> poster"
        width="300">
    </section>
    <section>
      <h1><?= $data["title"]; ?></h1>
      <p><?= $data["overview"]; ?></p>
      <p>Se estrena en <?= $data["days_until"]; ?> días</p>
      <p>Fecha de estreno <?= $data["release_date"]; ?></p>
      <p>La siguiente es <?= $data["following_production"]["title"] ?> </p>
    </section>
  </main>
</body>

</html>