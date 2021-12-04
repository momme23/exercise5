<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>
  <!-- Page Content -->
<div class="container">

       <!-- Side Navigation -->
           <?php include(TEMPLATE_FRONT . DS . "side_nav.php") ?>
    
<?php
    
    $query = query("SELECT * FROM articles WHERE article_id =" . escape_string($_GET['id']). " "); //help funktion stellt connection her und sendet daten
    confirm($query); //sicherstellen, dass alles funktioniert

    while($row= fetch_array($query)):
    
    ?>

<div class="col-md-9">

<div class="row">

    <div class="col-md-7">
       <img class="img-responsive" src="../resources/<?php echo display_image($row['article_image']); ?>" alt="">

    </div>

    <div class="col-md-5">

        <div class="thumbnail">
         

    <div class="caption-full">
        <h4><a href="#"><?php echo $row['article_title']; ?></a> </h4>
        <hr>
        <h4 class=""><?php echo $row['article_price'] . "€"; ?></h4>


          
    <?php echo $row['article_size']; ?>

   
    <form action="">
        <div class="form-group">
            <a href="../resources/cart.php?add=<?php echo $row['article_id']; ?>" class="btn btn-default" >Hinzufügen</a>
        </div>
    </form>

    </div>
 
</div>

</div>


</div>
<br>
    <br>
<div class="row">



<p></p>
<p><?php echo $row['article_description']; ?></p>

    </div>


 </div>

</div>



    
<?php endwhile; ?>


    <!-- /.container -->
<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>