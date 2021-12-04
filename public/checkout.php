<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>


<?php
    
    if(isset($_SESSION['article_1'])) {


    }
    
    ?>

    <div class="container">



<div class="row">
    
    <h4 class="text-center bg-danger"><?php display_message(); ?></h4>

      <h1>Warenkorb</h1>
<!-- pay pal sandbox-->

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="shop@businessanwendungentest.de">
<input type="hidden" name="currency_code" value="EUR">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Produkt</th>
           <th>Preis</th>
           <th>Anzahl</th>
           <th>Gesamtpreis</th>
     
          </tr>
        </thead>
        <tbody>
            <?php cart(); ?>
        </tbody>
    </table>
    <?php echo paypal_btn(); ?>
</form>



<!--  ***********WARENKORB GESAMT*************-->
            
<div class="col-md-4 pull-right ">
<h2>Warenkorb gesamt</h2>

<table class="table" cellspacing="0">

<tr class="article-amount">
<th>Artikel:</th>
<td><span class="amount">
    <?php 
    echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0"; 
    // wenn set echo, sonst assign empty string
    ?>
    </span></td>
</tr>
<tr class="order-total">
<th>Gesamtbetrag</th>
<td><strong><span class="amount">
    <?php 
    echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0"; 
    // wenn set echo, sonst assign empty string
    ?>&euro;
    </span></strong> </td>
</tr>




</table>

</div>


 </div>


</div>
<div class="container text-center">
<!--weiterleitung damit man auch auf die thank you seite kommt und die werte in die orders tabelle eingefügt werden-->
<a class="btn btn-success" href="thank_you.php?tx=21341&amt=300&cc=EUR&st=Completed">HIER KOMMT MAN ZUR SEITE FÜR ABGESCHLOSSENE BEZAHLUNG DA PAY PAL WEITERLEITUNG NICHT FUNKTIONIERT</a>
    </div>

    <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>