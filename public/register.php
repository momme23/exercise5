<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<?php register_user(); ?>
  <h1 class="page-header text-center">
      Registrierung
  </h1>



<form action="" method="post">

<div class="col-md-6">
      <div class="form-group">
          <label for="email">Email</label>
      <input type="text" name="email" class="form-control">
         
     </div>
      <div class="form-group">
          <label for="password">Passwort</label>
      <input type="password" name="password" class="form-control">
         
     </div>
          <div class="form-group">
          <label for="password">Passwort wiederholen</label>
      <input type="password" name="password2" class="form-control">
         
     </div>

      <div class="form-group">
          <label for="surname">Vorname</label>
      <input type="text" name="surname" rows="10" class="form-control">
         
     </div>

      
    </div>
    
<div class="col-md-6">

            
    <div class="form-group">
          <label for="name">Name</label>
      <input type="text" name="name" class="form-control">
         
     </div>
    
    <div class="form-group">
          <label for="adress">Adresse</label>
      <input type="text" name="adress" class="form-control">
         
     </div>
      
      <div class="form-group">
          <label for="postal">PLZ</label>
      <input type="text" name="postal" class="form-control">
         
     </div>
      
      <div class="form-group">
          <label for="city">Stadt</label>
      <input type="text" name="city" class="form-control">
         
     </div>



</div>
    
          <div class="form-group">

      <input type="submit" name="register_user" class="btn btn-default center-block" value="Registrieren" >
         
     </div>



<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>