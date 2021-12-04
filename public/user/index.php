<!-- USER BEREICH -->
<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_BACK . "/header_user.php"); ?>

<?php 

if(!isset($_SESSION['email'])) {
    
    redirect("../../public/login.php");
}

?> 
<div class="col-md-offset-2 col-md-8">
<div class="row">
<h1 class="page-header text-center">Hallo, <?php echo($_SESSION['surname']); ?> <?php echo($_SESSION['name']); ?></h1>
             <div class="container">

<h4 class="text-center">Hier sind deine Daten</h4>
</div>
    
                            <div class="col-md-12">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>E-Mail</th>
                                        <th>Vorname</th>
                                        <th>Name</th>
                                        <th>Adresse</th>
                                        <th>PLZ</th>
                                        <th>Ort</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php user_personal(); ?>
                                    
                                </tbody>
                            </table> 
                                
                                <h4 class="text-center">Hier sind deine Bestellungen</h4>

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
        
        <?php orders_user(); ?>
        

    </tbody>
</table>
</div>

<?php include(TEMPLATE_BACK . "/footer.php"); ?>