<?php mysqli_set_charset($connection, "utf8"); ?>

<!DOCTYPE html>
<html lang="de">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Zosimos Zaubertrankfachhandel</title>


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="css/webshop.css" rel="stylesheet">

    <link href="css/styles.css" rel="stylesheet">


</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <?php include(TEMPLATE_FRONT . DS . "top_nav.php") ?>
    </nav>