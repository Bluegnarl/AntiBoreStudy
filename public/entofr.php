<?php
// Démarrage du script PHP
$state = $_GET['state'] ?? null;

function nextphp() {
    $study = json_decode(file_get_contents(__DIR__ . '/bricks.json'));
    $study_length = count($study);
    $study_rand = rand(0, $study_length - 1);
    $study_local = array(
        "french" => $study[$study_rand]->french,
        "english" => $study[$study_rand]->english
    );

    // Encode the study_local array to a JSON string and set it as a cookie
    setcookie('study_local', json_encode($study_local), time() + 3600, '/');
}

if ($state == 'next') {
    nextphp();
    header("Location: /public/entofr.php");
    exit();
}

$response = $_GET['response'] ?? null;
$study_local = isset($_COOKIE['study_local']) ? json_decode($_COOKIE['study_local'], true) : null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/styles/style.css">
    <title>EasyStudy</title>
</head>
<body>
<a href="/public/home.php" style="position: absolute; top: 0; margin: 24px; width: auto; font-weight: 600;">Main Menu</a>

<?php if ($state == 'response' && $response !== null && $study_local) : ?>
    <p class="<?= ($response == $study_local['french']) ? "correct" : "incorrect" ?>">
        Your response "<?= htmlspecialchars($response) ?>" is <?= ($response == $study_local['french']) ? "correct" : "incorrect" ?>
    </p>
<?php endif ?>

<form action="/public/entofr.php" method="get">
    <p><h3> English :</h3> <?= $study_local ? htmlspecialchars($study_local['english']) : '' ?></p>
    <input type="text" name="response" value="<?= htmlspecialchars($response) ?>" placeholder="Response In French">
    <input type="hidden" name="state" value="response">
    <button type="submit">Send</button>
</form>
<a href="/public/entofr.php?state=next">Randomize</a>
<footer>Par <b>Koçak Ali</b> ou <b>Bluegnarl</b></footer>
</body>
</html>
