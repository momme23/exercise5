



<?php add_article(); ?>


<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Produkt Hinzufügen

</h1>
</div>
               

<!-- Diverse Input Felder für die einzelnen Spalten der articles Datenbank -->
<form action="" method="post" enctype="multipart/form-data"> <!-- enctype sendet bilder daten -->


<div class="col-md-8">

<div class="form-group">
    <label for="article-title">Produkt Name</label>
        <input type="text" name="article_title" class="form-control">
       
    </div>


    <div class="form-group">
           <label for="article-title">Produkt Beschreibung</label>
      <textarea name="article_description" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="article-price">Produkt Preis</label>
        <input type="number" name="article_price" step=".01" class="form-control" size="60">
      </div>
    </div>
    
        <div class="form-group">
           <label for="article-title">Produkt Kurzinformation</label>
      <textarea name="article_size" id="" cols="30" rows="2" class="form-control"></textarea>
    </div>

</div>
    





<aside id="more_details" class="col-md-4">




     <!-- Produkt Kategorie, hier brauchen wir eine Funktion um aus den vorhandenen Kategorien auszuwählen-->

    <div class="form-group">
         <label for="article-title">Produkt Kategorie</label>
        <select name="article_category_id" id="" class="form-control">
            <option value="">Kategorie auswählen</option>
            
            <?php categories_addarticle(); ?>
           
        </select>
        
        
        


</div>





    <!-- Produkt Anzahl-->


    <div class="form-group">
      <label for="article-title">Produkt Anzahl</label>
         <input type="number" name="article_quantity" class="form-control">
    </div>


    <!-- Produkt Bild -->
    <div class="form-group">
        <label for="article-title">Produkt Bild</label>
        <input type="file" name="file">
      
    </div>


</aside>
         
     <div class="form-group">
        <input type="submit" name="publish" class="btn btn-default btn-lg" value="Hinzufügen">
    </div>


    
</form>

