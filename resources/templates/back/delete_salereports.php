<?php require_once("../../resources/config.php");



if(isset($_GET['delete_salereports_id'])) {
    
    $query = query("DELETE FROM salereports WHERE salereport_id = " . escape_string($_GET['delete_salereports_id']) . " ");
    confirm($query);
    
    set_message("Eintrag wurde entfernt!");
    
    redirect("index.php?salereports");
    
} else {
    redirect("index.php?salereports");
}



?>