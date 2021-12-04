
<?php mysqli_set_charset($connection, "utf8"); ?>

<!DOCTYPE html>
<html lang="de">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Zosimos Zaubertrankfachhandel</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/user.css" rel="stylesheet">


</head>

<body>

    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <!-- Kopfleiste -->
            <?php include(TEMPLATE_BACK . "/top_nav_user.php"); ?>    
        </nav>