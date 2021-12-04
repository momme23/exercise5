<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>


<div class="jumbotron text-center">
<h1>ALLE ZAUBERTRÄNKE</h1>
</div>

    <div class="container">



        <div class="row align-items-center text-center">

            <?php all_articles(); ?>
        </div>


    </div>

    <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
