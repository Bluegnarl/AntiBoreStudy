<?php

$study = json_decode(file_get_contents(__DIR__ . '/datas/bricks.json'), true);

$name = $_POST['name'] ?? null;

if($name) {
    $study[0]['name'] = $name;

    file_put_contents(__DIR__ . '/datas/bricks.json', json_encode($study));

    header('Location: /');
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
<form action="/" method="post">
    <input type="text" name="name" placeholder="Response">
    <button type="submit">Send</button>
</form>
</body>
</html>
