<?php require_once("../../resources/config.php");



if(isset($_GET['delete_article_id'])) {
    
    $query = query("DELETE FROM articles WHERE article_id = " . escape_string($_GET['delete_article_id']) . " ");
    confirm($query);
    
    set_message("Produkt wurde entfernt!");
    
    redirect("index.php?articles");
    
} else {
    redirect("index.php?articles");
}



?>