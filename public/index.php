<?php

function home(){
    require_once __DIR__ . "/home.php";
}

function frtoen(){
    require_once __DIR__ . "/frtoen.php";
}

function entofr(){
    require_once __DIR__ . "/entofr.php";
}

$page = $_GET['page'] ?? null;

switch ($page) {
    case 'home':
        home();
    break;
    case 'frtoen':
        frtoen();
    break;
    case 'entofr':
        entofr();
        break;
    default:
        home();
        break;
}

?>
