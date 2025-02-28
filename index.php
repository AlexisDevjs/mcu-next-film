<?php

require_once 'lib/app-constants.php';
require_once 'lib/functions.php';
require_once 'classes/NextMovie.php';

$next_movie = NextMovie::fetch_and_create(API_URL);
$next_movie_data = array_merge(
  $next_movie->get_data(),
  ["days_until_message" => $next_movie->get_days_until()]
);
?>

<!DOCTYPE html>
<html lang="es">

<?= render_template('head') ?>
<?= render_template('styles') ?>

<body>
  <?= render_template('main', $next_movie_data) ?>
</body>

</html>