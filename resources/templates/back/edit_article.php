<?php 

//prüfen ob produkt vorhanden
if(isset($_GET['id'])) {
    
    
    $query = query("SELECT * FROM articles WHERE article_id = " . escape_string($_GET['id']) . " ");
    confirm($query);
    
    //loop um daten rauszuziehen
    while($row = fetch_array($query)) {
        
$article_title          = escape_string($row['article_title']);
$article_category_id    = escape_string($row['article_category_id']);
$article_price          = escape_string($row['article_price']);
$article_description    = escape_string($row['article_description']);
$article_size             = escape_string($row['article_size']);
$article_quantity       = escape_string($row['article_quantity']);
$article_image          = escape_string($row['article_image']);
        
        
$article_image = display_image($row['article_image']); //damit wir später ein kleines produkt bild anzeigen können
        
    }

    edit_article(); 
}



?>
<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Produkt Bearbeiten

</h1>
</div>
               

<!-- Diverse Input Felder für die einzelnen Spalten der articles Datenbank -->
<form action="" method="post" enctype="multipart/form-data"> <!-- enctype sendet bilder daten -->


<div class="col-md-8">

<div class="form-group">
    <label for="article-title">Produkt Name</label>
        <input type="text" name="article_title" class="form-control" value="<?php echo $article_title; ?>">
       
    </div>


    <div class="form-group">
           <label for="article-title">Produkt Beschreibung</label>
      <textarea name="article_description" id="" cols="30" rows="10" class="form-control"><?php echo $article_description; ?></textarea>
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="article-price">Produkt Preis</label>
        <input type="number" name="article_price" step=".01" class="form-control" size="60" value="<?php echo $article_price; ?>">
      </div>
    </div>
    
        <div class="form-group">
           <label for="article-title">Produkt Kurzinformation</label>
      <textarea name="article_size" id="" cols="30" rows="2" class="form-control"><?php echo $article_size; ?></textarea>
    </div>

</div>
    



<aside id="moredetails" class="col-md-4">

     
     <div class="form-group">
        <input type="submit" name="update" class="btn btn-default btn-lg" value="Fertig">
    </div>


     <!-- Produkt Kategorie, hier brauchen wir eine Funktion um aus den vorhandenen Kategorien auszuwählen-->

    <div class="form-group">
         <label for="article-title">Produkt Kategorie</label>
        <select name="article_category_id" id="" class="form-control">
            <option value="<?php echo $article_category_id; ?>"><?php echo article_category_title($article_category_id); ?></option>
            <!-- hier wollen wir beim bearbeiten auch die aktuelle kategorie im dropdowmn anzeigen, deshalb benutzen wir die obige funktion -->
            <?php categories_addarticle(); ?>
           
        </select>


</div>





    <!-- Produkt Anzahl-->


    <div class="form-group">
      <label for="article-title">Produkt Anzahl</label>
         <input type="number" name="article_quantity" class="form-control" value="<?php echo $article_quantity; ?>">
    </div>




    <!-- Produkt Bild -->
    <div class="form-group">
        <label for="article-title">Produkt Bild</label>
        <input type="file" name="file"> <br>
        <img width='160' src="../../resources/<?php echo $article_image; ?>" alt="">
      
    </div>


</aside>


    
</form>

