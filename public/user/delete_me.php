<?php require_once("../../resources/config.php");



if(isset($_GET['id'])) {
    
    $query = query("DELETE FROM users WHERE user_id = " . escape_string($_GET['id']) . " ");
    confirm($query);
    
    set_message("Benutzer wurde entfernt!");
    
    session_destroy();
    
    redirect("../index.php");
    
} else {
    redirect("../index.php");
}



?>