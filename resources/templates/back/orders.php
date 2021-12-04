
<div class="col-md-12">
<div class="row">
<h1 class="page-header">
   Alle Bestellungen

</h1>
    
<h4 class="bg-success"><?php display_message(); ?></h4>
</div>

<div class="row">
<table class="table">
    <thead>

      <tr>
               <th>ID</th>
               <th>Nutzer ID</th>
               <th>Summe</th>
               <th>Währung</th>
               <th>Transaktion</th>
               <th>Status</th>
      </tr>
    </thead>
    <tbody>
        
        <?php orders_admin(); ?>
        

    </tbody>
</table>
</div>

