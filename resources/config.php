<?php

session_start();
//session_destroy();

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
//konstanten um später per php sachen wie header etc einfacher einbinden zu können und arbeit zu sparen
defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front");

defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");

defined("UPLOAD_FOLDER") ? null : define("UPLOAD_FOLDER", __DIR__ . DS . "uploads");

/*******************HIER BITTE EIGENE DATEN EINGEBEN*************************/

defined("DB_HOST") ? null : define("DB_HOST", "localhost");

defined("DB_USER") ? null : define("DB_USER", "root");

defined("DB_PASS") ? null : define("DB_PASS", "momme");

defined("DB_NAME") ? null : define("DB_NAME", "webshop_db");



$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

require_once("functions.php");
require_once("cart.php");
?>