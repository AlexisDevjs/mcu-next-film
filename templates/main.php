<main>
  <section>
    <img
      src="<?= $poster_url ?>"
      alt="<?= $title ?> poster"
      width="300">
  </section>
  <section>
    <h1><?= $title ?></h1>
    <p><?= $overview ?></p>
    <p><?= $days_until_message; ?></p>
    <p>Fecha de estreno: <?= $release_date ?></p>
    <p>
      La siguiente es: <?= $following_production["title"] ?? 'Desconocido' ?>
    </p>
  </section>
</main>