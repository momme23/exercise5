<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>


<div class="jumbotron text-center" name="homepagejumbotron">
<h1>Lorem ipsum Zaubertrankfachhandel</h1>
</div>
    <div class="container">

        <div class="row">

           <!--kategorien hier -->
           <?php include(TEMPLATE_FRONT . DS . "side_nav.php") ?>
            <div class="col-md-9"> <!--col 9 damit kategorien links daneben-->



                <div class="row">


                <?php get_articles(); ?> <!-- führt die get articles funktion aus der functions.php aus-->



                </div>

            </div>

        </div>

    </div>

    <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
