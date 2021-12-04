<!-- USER BEREICH -->
<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_BACK . "/header_user.php"); ?>

<?php 

if(!isset($_SESSION['email'])) {
    
    redirect("../../public/login.php");
}

?> 

<?php


if(isset($_GET['id'])) {
    
    
    $query = query("SELECT * FROM users WHERE user_id = " . escape_string($_GET['id']) . " ");
    confirm($query);
    
    //loop um daten rauszuziehen
    while($row = fetch_array($query)) {
        
        $email      = escape_string($row['email']);
        $surname    = escape_string($row['surname']);
        $name       = escape_string($row['name']);
        $adress     = escape_string($row['adress']);
        $postal     = escape_string($row['postal']);
        $city       = escape_string($row['city']);
        
    }

edit_user();
}
        
  ?>      


<form action="" method="post">

<div class="col-md-6">
      <div class="form-group">
          <label for="email">Email</label>
      <input type="text"  disabled name="email" class="form-control" value="<?php echo $email; ?>">
         
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
      <input type="text" name="surname" rows="10" class="form-control" value="<?php echo $surname; ?>">
         
     </div>

      
    </div>
    
<div class="col-md-6">

            
    <div class="form-group">
          <label for="name">Name</label>
      <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
         
     </div>
    
    <div class="form-group">
          <label for="adress">Adresse</label>
      <input type="text" name="adress" class="form-control" value="<?php echo $adress; ?>">
         
     </div>
      
      <div class="form-group">
          <label for="postal">PLZ</label>
      <input type="text" name="postal" class="form-control" value="<?php echo $postal; ?>">
         
     </div>
      
      <div class="form-group">
          <label for="city">Stadt</label>
      <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
         
     </div>



</div>
    
          <div class="form-group">

      <input type="submit" name="update_user" class="btn btn-success center-block" value="Aktualisieren" >
         
     </div>



<?php include(TEMPLATE_BACK . "/footer.php"); ?>