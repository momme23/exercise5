<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<?php
    
    $query = query("SELECT * FROM categories WHERE cat_id =" . escape_string($_GET['id']). " "); //help funktion stellt connection her und sendet daten
    confirm($query); //sicherstellen, dass alles funktioniert

    while($row= fetch_array($query)):
    
    ?>
<div class="jumbotron">
    <div class="container">
        <div class="row text-center">
<h1><?php echo($row['cat_title']); ?></h1>
    <p><?php echo($row['cat_desc']); ?></p>
</div>
    </div>
    </div>
    <div class="container">

        <div class="row text-center">

            <?php get_articles_category(); ?>
        </div>
    </div>
    
<?php endwhile; ?>
    <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
