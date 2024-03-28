<?php
session_start();

$state = $_GET['state'] ?? null;

function nextphp() {
    $study = json_decode(file_get_contents('./bricks.json'));
    $study_length = count($study);
    $study_rand = rand(0, $study_length - 1); // Corrected the range
    $study_local = array(
        "french" => $study[$study_rand]->french,
        "english" => $study[$study_rand]->english
    );

    $_SESSION['study_local'] = $study_local;
    header('Location: /frtoen.php'); // Rediriger vers cette page même
    exit;
}

if ($state == 'next') {
    nextphp();
}

$response = $_GET['response'] ?? null;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/style.css">
    <title>EasyStudy</title>
</head>
<body>
<a href="/" style="position: absolute; top: 0; margin: 24px; width: auto; font-weight: 600;">Main Menu</a>
<span>Don't use <b>capital letters</b> and don't forget <b>"to" before an infinitive</b></span>
<?php if ($state == 'response' && $response !== null) : ?>
    <p class="<?= ($response == $_SESSION['study_local']['english']) ? "correct" : "incorrect" ?>">Your response "<?= $response ?>" is <?= ($response == $_SESSION['study_local']['english']) ? "correct" : "incorrect" ?></p>
<?php endif ?>
<form action="./frtoen.php" method="get"> <!-- Modifié pour rediriger vers la même page -->
    <p><h3> French :</h3> <?= isset($_SESSION['study_local']['french']) ? $_SESSION['study_local']['french'] : '' ?></p>
    <input type="text" name="response" value="<?= $response ?>" placeholder="Response In English">
    <input type="hidden" name="state" value="response">
    <button type="submit">Send</button>
</form>
<a href="frtoen.php?state=next">Next</a>
<footer>Par <b>Koçak Ali</b> ou <b>Bluegnarl</b></footer>
</body>
</html>
