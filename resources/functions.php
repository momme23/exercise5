<?php


//upload directory
$uploads = "uploads";
//funktionen help
//redirect funktion
function redirect($location) {

    return header("Location: $location ");
}

function last_id(){ //funktion um bei bestellung eine order id an die salereports datenbank zu übertragen
    
    global $connection;
    
    return mysqli_insert_id($connection);
    
    
}
//message funktionen um den user z.B. auf falsches passwort/email hinzuweisen oder bei hinzufügen/löschen von datenbankeinträgen speichert message in session
function set_message($msg){
    
    if(!empty($msg)){
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}
//display der set message aus der session
function display_message(){
    
    if(isset($_SESSION['message'])){
        
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}
//mysql query
function query($sql) {

    global $connection; //ohne global andere variable und nicht die gewünschte

    return mysqli_query($connection, $sql);
}
//confirm funktion um beim testen schnell zu wissen ob eine query nicht geklappt hat, kann man später entfernen
function confirm($result){

    global $connection;

    if(!$result) {
        die("FEHLER" . mysqli_error($connection));
    }
}
//escape funktion um sql injection zu umgehen
function escape_string($string){ //sql injection vermeiden

    global $connection;

    return mysqli_real_escape_string($connection, $string);
}
//funktion zum fetchen einer row als array
function fetch_array($result) {

    return mysqli_fetch_array($result);
}

//produkt funktionen
/******************************************FRONT END***********************************************/
//funktion um produkt daten aus datenbank zu ziehen und diese anschließend darzustellen
function get_articles() {

    $query = query("SELECT * FROM articles WHERE article_quantity >= 1 "); //help funktion stellt connection her und sendet daten
    confirm($query); //sicherstellen, dass alles funktioniert
    
$rows = mysqli_num_rows($query); //anzahl aller rows aus unserer datenbank
    
if(isset($_GET['page'])){ //page aus der url ziehen wenn vorhanden

    $page = preg_replace('#[^0-9]#', '', $_GET['page']);//alles rausfilter außer nummern



} else{ //wenn es keine page nummer gibt, auf 1 setzen

    $page = 1;

}


$perPage = 6; //Artikel pro seite 

$lastPage = ceil($rows / $perPage); //value der letzten seite

//die page nummer soll nicht kleiner als 1 oder größer als die der letzten seite sein

if($page < 1){ //keliner als 1

    $page = 1; //forciere 1

}elseif($page > $lastPage){ //größer als letzte seite

    $page = $lastPage; //forciere letzte seite

}



$center = ''; // Initialize this variable

// This creates the numbers to click in between the next and back buttons


$subtract1 = $page - 1;
$subtract2 = $page - 2;
$add1 = $page + 1;
$add2 = $page + 2;



if($page == 1){

      $center .= '<li class="page-item active"><a>' .$page. '</a></li>';

      $center .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

} elseif ($page == $lastPage) {
    
      $center .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$subtract1.'">' .$subtract1. '</a></li>';
      $center .= '<li class="page-item active"><a>' .$page. '</a></li>';

}elseif ($page > 2 && $page < ($lastPage -1)) {

      $center .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$subtract2.'">' .$subtract2. '</a></li>';

      $center .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$subtract1.'">' .$subtract1. '</a></li>';

      $center .= '<li class="page-item active"><a>' .$page. '</a></li>';

      $center .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

      $center .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'">' .$add2. '</a></li>';

     


} elseif($page > 1 && $page < $lastPage){

     $center .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page= '.$subtract1.'">' .$subtract1. '</a></li>';

     $center .= '<li class="page-item active"><a>' .$page. '</a></li>';
 
     $center .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';


     


}


//limit setzen plus 2 werte für die inhalte rows aus der datenbank

$limit = 'LIMIT ' . ($page-1) * $perPage . ',' . $perPage;




// query um die produkte aus unserem limit darzustellen

$querylimit = query(" SELECT * FROM articles $limit");
confirm($querylimit);


$pagination = ""; //variable zur darstellung


//zurück button für alles außer page 1

if($page != 1){


    $prev  = $page - 1;

    $pagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'"><</a></li>';
}

//verbinden

$pagination .= $center;


//next button für alles außer der letzten seite

if($page != $lastPage){


    $next = $page + 1;

    $pagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'">></a></li>';

}
    
    
    while($row= fetch_array($querylimit)) {
        
    $article_image = display_image($row['article_image']);
//delimeter damit man nicht die Anführungszeichen ständig ändern muss
    $article= <<<DELIMETER
    <div class="col-md-4 text-center">
         <div class="thumbnail">
            <a href="item.php?id={$row['article_id']}"><img src="../resources/{$article_image}" alt=""></a>
            <div class="desc">
                <h5>{$row['article_price']}&euro;</h5>
                <p><a href="item.php?id={$row['article_id']}">{$row['article_title']}</a>
                </p>
                <h6>{$row['article_size']}</h6>
                <a class="btn btn-block btn-default align-self-end" target="_blank" href="../resources/cart.php?add={$row['article_id']}">Jetzt Kaufen!</a>
            </div>
        
        </div>
    </div>

DELIMETER;
    
echo $article;
}
    
    echo "<div class='text-center'><ul class='pagination'>{$pagination}</ul></div>";
}
//alle kategorien aus der datenbank ziehen und darstellen
function get_categories(){
   
$query = query("SELECT * FROM categories");
confirm($query);

while($row = mysqli_fetch_array($query)) { //looped durch query
            
$categories_links= <<<DELIMETER

<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>

DELIMETER;

echo $categories_links;
        }
}

//funktion sucht die produkte der entsprechenden kategorie id und stellt sie dar
function get_articles_category() {

    $query = query("SELECT * FROM articles WHERE article_category_id = " . escape_string($_GET['id']). " AND article_quantity >= 1 "); 
    //help funktion stellt connection her und sendet daten
    confirm($query); //sicherstellen, dass alles funktioniert

while($row= fetch_array($query)) {
    
    $article_image = display_image($row['article_image']);
    
    $article = <<<DELIMETER
    <div class="col-md-3">
                <div class="thumbnail">
                    <a href="item.php?id={$row['article_id']}"><img src="../resources/{$article_image}" alt=""></a>
                    <div class="desc">
                        <h4>{$row['article_title']}</h4>
                        <p>{$row['article_size']}</p>
                            <a class="btn btn-block btn-default align-self-end" href="../resources/cart.php?add={$row['article_id']}">Jetzt Kaufen!</a>
                    </div>
                </div>
            </div>
DELIMETER;
    echo $article;
}
}
//alle produkte aus der datenbank und alle darstellen
function all_articles() {

    $query = query("SELECT * FROM articles WHERE article_quantity >= 1"); 
    //help funktion stellt connection her und sendet daten
    confirm($query); //sicherstellen, dass alles funktioniert

while($row= fetch_array($query)) {
    
$article_image = display_image($row['article_image']);
    
    $article = <<<DELIMETER
    <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../resources/{$article_image}" alt="">
                    <div class="caption">
                        <h3>{$row['article_title']}</h3>
                        <p>{$row['article_size']}</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['article_id']}" class="btn btn-default">Jetzt kaufen!</a> <a href="item.php?id={$row['article_id']}" class="btn btn-default">Mehr</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMETER;
    echo $article;
}
}
//wenn der eingegebene user in der datenbank vorhanden ist, wird er entsprechend eingeloggt, sonst warnung
function login_user() {
    
    if(isset($_POST['submit'])){
        $email = escape_string($_POST['email']);
        $query = query("SELECT * FROM users WHERE email = '$email'");
        confirm($query);
        //anzahl der rows returnen
    if(mysqli_num_rows($query) == 0) {
            
            set_message("Email inkorrekt");
            redirect("login.php"); //wenn kein email/password gefunden, dann redirect auf login.php
       }
    else {
            $user = $query->fetch_assoc(); //fetched die zugehörigen daten
        
        if(password_verify($_POST['password'], $user['password'])) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['surname'] = $user['surname'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['admin'] = $user['admin'];
            //daten die in session gespeichert werden
            redirect("index.php");
        } else {
            set_message("Password inkorrekt");
            redirect("login.php");
        }
            
        }
    }
}
//funktion für die kontaktseite die aber nicht funktioniert
function send_message() {
    
    if(isset($_POST['submit'])){
        
        $to        = "anyEmailaddress123@web.de";
        $from_name = $_POST['name'];
        $email     = $_POST['email'];
        $subject   = $_POST['subject'];
        $message   = $_POST['message'];
        
        $headers = "Von: {$from_name} {$email}";
        
        $result= mail($to, $subject, $message, $headers);
        
        if(!$result) {
            set_message("Fehler beim Senden");
            redirect("contact.php");
        } else {
            set_message("GESENDET");
        }
        
        
    }
}

/***********************************BACK END ************************************/
//wie in add user im adminbereich, der user kann sich mit entsprechenden eingaben in die Datenbank eintragen und wird zum login weitergeleitet
function register_user(){
    
    if(isset($_POST['register_user'])) {
        $error = false;
        $email      = escape_string($_POST['email']);
        $password   = escape_string($_POST['password']);
        $password2  = escape_string($_POST['password2']);
        $surname    = escape_string($_POST['surname']);
        $name       = escape_string($_POST['name']);
        $adress     = escape_string($_POST['adress']);
        $postal     = escape_string($_POST['postal']);
        $city       = escape_string($_POST['city']);
        
        $result = query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error);
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'bitte gütlige email<br>';
            $error = true;
        }
        if(strlen($password) == 0) {
            echo 'bitte passwort<br>';
            $error = true;
        }if($password != $password2) {
            echo 'pw müssen stimmen<br>';
            $error = true;
        }
        if ( $result->num_rows > 0 ) {
    
            echo 'User with this email already exists!<br>';
            $error = true;
    
}
        
        if(!$error) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        
        $query = query("INSERT INTO users(email, password, surname, name, adress, postal, city) VALUES('{$email}', '{$password_hash}', '{$surname}', '{$name}', '{$adress}', '{$postal}', '{$city}')");
        confirm($query);
        
        set_message("Benutzer erstellt");
        
        redirect("login.php");
    }
}
}
//Back end darstellung der Bestellungen
function orders_admin() {
    
    $query = query("SELECT * FROM orders");
    confirm($query);
    
    
    while($row = fetch_array($query)) {
        
        $orders = <<<DELIMETER
<tr>
    <td>{$row['order_id']}</td>
    <td>{$row['user_id']}</td>
    <td>{$row['order_amount']}</td>
    <td>{$row['order_transaction']}</td>
    <td>{$row['order_currency']}</td>
    <td>{$row['order_status']}</td>
    <td><a class="btn btn-danger" href="index.php?delete_order_id={$row['order_id']}"><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>   
DELIMETER;
        
        echo $orders;
    }
}
//sucht für den user alle bestellungen mit seiner id raus
function orders_user() {
        
    $query = query("SELECT * FROM orders WHERE user_id = '{$_SESSION['user_id']}'");
    confirm($query);
    
        while($row = fetch_array($query)) {
        
        $orders = <<<DELIMETER
<tr>
    <td>{$row['order_id']}</td>
    <td>{$row['user_id']}</td>
    <td>{$row['order_amount']}</td>
    <td>{$row['order_currency']}</td>
    <td>{$row['order_transaction']}</td>
    <td>{$row['order_status']}</td>
</tr>   
DELIMETER;
        
        echo $orders;
    }
}


/*************************ADMIN PRODUKTE**********************************/
function display_image($picture) {
    //funktion um das bilder anzeigen zu vereinfachen, falls sich der speicherort ändert -> nur an einer stelle anpassen und nicht an allen orten wo diese eingesetzt wurde
    global $uploads;
    
    return $uploads . DS . $picture;
    
}
//alle produkte im adminbereich darstellen, mit DELETE button und bild
function articles_admin() {
    

    $query = query("SELECT * FROM articles"); //help funktion stellt connection her und sendet daten
    confirm($query); //sicherstellen, dass alles funktioniert

    while($row= fetch_array($query)) {
        
    $category = article_category_title($row['article_category_id']);

    $article_image = display_image($row['article_image']);
        
    $article= <<<DELIMETER
    <tr>
        <td>{$row['article_id']}</td>
        <td>{$row['article_title']}<br>
        <a href="index.php?edit_article&id={$row['article_id']}"><img width='80' src="../../resources/{$article_image}" alt=""></a>
        </td>
        <td>{$category}</td>
        <td>{$row['article_price']}</td>
        <td>{$row['article_quantity']}</td>
        <td><a class="btn btn-danger" href="index.php?delete_article_id={$row['article_id']}"><span class="glyphicon glyphicon-trash"></span></a></td>
    </tr>
DELIMETER;
    
echo $article;
}
}
//benötigt damit beim produkt im adminbereich der richtige kategoriename angezeigt wird
function article_category_title($article_category_id){
    
    $category_query = query("SELECT * FROM categories WHERE cat_id = {$article_category_id} ");
    confirm($category_query);
    //loop
    while($category_row = fetch_array($category_query)) {
        
        return $category_row['cat_title'];
    }
    
}

/**************************ADMIN HINZUFÜGEN VON PRODUKTEN***************************/
//Produkte hinzufügen aus dem Adminbereich, das bild wird in den upload folder geladen
function add_article() {
    
    if(isset($_POST['publish'])){
        
    $article_title          = escape_string($_POST['article_title']);
    $article_category_id    = escape_string($_POST['article_category_id']);
    $article_price          = escape_string($_POST['article_price']);
    $article_description    = escape_string($_POST['article_description']);
    $article_size             = escape_string($_POST['article_size']);
    $article_quantity       = escape_string($_POST['article_quantity']);
    $article_image          = escape_string($_FILES['file']['name']);
    $image_temp_location    = escape_string($_FILES['file']['tmp_name']);
        
        
move_uploaded_file($image_temp_location , UPLOAD_FOLDER . DS . $article_image);
        
$query = query("INSERT INTO articles(article_title, article_category_id, article_price, article_description, article_size, article_quantity, article_image) VALUES('{$article_title}', '{$article_category_id}', '{$article_price}', '{$article_description}', '{$article_size}', '{$article_quantity}', '{$article_image}')");
        
        $last_id = last_id();
        confirm($query);
        set_message("{$article_title} zu Produkten hinzugefügt!");
        redirect("index.php?articles");
        
        
        
    }
}
//Anzeigen der Kategorien in addarticle, ähnliche Funktion wie die normale get_categories
function categories_addarticle(){
   
$query = query("SELECT * FROM categories");
confirm($query);

while($row = mysqli_fetch_array($query)) { //looped durch query
            
$categories_options= <<<DELIMETER

<option value="{$row['cat_id']}">{$row['cat_title']}</option>

DELIMETER;

echo $categories_options;
        }
}

/****************************produkt bearbeiten (quasi add article 2.0)****************************/
function edit_article() {
    
    if(isset($_POST['update'])){
        
    $article_title          = escape_string($_POST['article_title']);
    $article_category_id    = escape_string($_POST['article_category_id']);
    $article_price          = escape_string($_POST['article_price']);
    $article_description    = escape_string($_POST['article_description']);
    $article_size             = escape_string($_POST['article_size']);
    $article_quantity       = escape_string($_POST['article_quantity']);
    $article_image          = escape_string($_FILES['file']['name']);
    $image_temp_location    = escape_string($_FILES['file']['tmp_name']);
        
    if(empty($article_image)) { //verhindern, dass nach edit produkt kein produktbild mehr angezeigt wird
        
        $get_image = query("SELECT article_image FROM articles WHERE article_id =" .escape_string($_GET['id']). "");
        confirm($get_image);
        
        while ($img = fetch_array($get_image)) {
            $article_image = $img['article_image'];
        }
    }
        
        
move_uploaded_file($image_temp_location , UPLOAD_FOLDER . DS . $article_image);
        
$query = "UPDATE articles SET ";
$query .= "article_title        = '{$article_title}', ";
$query .= "article_category_id  = '{$article_category_id}', ";
$query .= "article_price        = '{$article_price}', ";
$query .= "article_description  = '{$article_description}', ";
$query .= "article_size           = '{$article_size}', ";
$query .= "article_quantity     = '{$article_quantity}', ";
$query .= "article_image        = '{$article_image}' ";
$query .= "WHERE article_id=" . escape_string($_GET['id']);
        
$send_update_query = query($query);
    
        confirm($send_update_query);
        set_message("Produkt bearbeitet!");
        redirect("index.php?articles");
        
        
        
    }
}

/***********************admin kategorien darstellen*******************/
// option kategorien zu löschen
function show_categories_admin() {
    
    $category_query = query("SELECT * FROM categories");
    confirm($category_query);
    
    while($row = fetch_array($category_query)) {
        
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title']; //
        
    $category = <<<DELIMETER
    <tr>
        <td>{$cat_id}</td>
        <td>{$cat_title}</td>
        <td><a class="btn btn-danger" href="index.php?delete_category_id={$row['cat_id']}"><span class="glyphicon glyphicon-trash"></span></a></td>
    </tr>
DELIMETER;
        
    echo $category; //echo den obigen delimeter
    }
}

//kategorie name und beschreibung werden in datenbank eingetragen, bei leerem feld warnung
function add_category() {
    
    if(isset($_POST['add_category'])) {
        
        $cat_title = escape_string($_POST['cat_title']);
        $cat_desc  = escape_string($_POST['cat_desc']);
        
    if(empty($cat_title) || $cat_title == " ") { //wenn eingabefeld leer warnung
        echo "<p class='bg-danger'>Bitte Namen eingeben</p>";
    } else {
        
        $insert_category = query("INSERT INTO categories(cat_title, cat_desc) VALUES('{$cat_title}','{$cat_desc}')");
        confirm($insert_category);
        set_message("Kategorie hinzugefügt");
    }
    }
}

/***************************USER BEARBEITEN UND ANZEIGEN ADMINBEREICH**********************************/
//Funktion um dem Admin alle User und deren Daten anzuzeigen, Admin kann User löschen
function users_admin() { //siehe categories admin
    
    $user_query = query("SELECT * FROM users");
    confirm($user_query);
    
    while($row = fetch_array($user_query)) {
        
    $user_id = $row['user_id'];
    $email = $row['email'];
    $surname = $row['surname'];
    $name = $row['name'];
    $adress = $row['adress'];
    $postal = $row['postal'];
    $city = $row['city'];
        
    $user = <<<DELIMETER
    <tr>
        <td>{$user_id}</td>
        <td>{$email}</td>
        <td>{$surname}</td>
        <td>{$name}</td>
        <td>{$adress}</td>
        <td>{$postal}</td>
        <td>{$city}</td>
        <td><a class="btn btn-danger" href="index.php?delete_user_id={$row['user_id']}"><span class="glyphicon glyphicon-trash"></span></a></td>
    </tr>
DELIMETER;
        
    echo $user; //echo den obigen delimeter
    }
}
//funktion um den user aus dem adminbereich hinzuzufügen
function add_user(){
    
    if(isset($_POST['add_user'])) {
        
        $email      = escape_string($_POST['email']);
        $password   = escape_string($_POST['password']);
        $surname    = escape_string($_POST['surname']);
        $name       = escape_string($_POST['name']);
        $adress     = escape_string($_POST['adress']);
        $postal     = escape_string($_POST['postal']);
        $city       = escape_string($_POST['city']);
        
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        $query = query("INSERT INTO users(email, password, surname, name, adress, postal, city) VALUES('{$email}', '{$password_hash}', '{$surname}', '{$name}', '{$adress}', '{$postal}', '{$city}')");
        confirm($query);
        
        set_message("Benutzer erstellt");
        
        redirect("index.php?users");
    }
}
//Alle Verkäufe/Statistiken anzeigen für den Admin
function get_salereports() { //ähnlich wie get articles admin
    

    $query = query("SELECT * FROM salereports"); //help funktion stellt connection her und sendet daten
    confirm($query); //sicherstellen, dass alles funktioniert

    while($row= fetch_array($query)) {
        
    $salereport= <<<DELIMETER
    <tr>
        <td>{$row['salereport_id']}</td>
        <td>{$row['article_id']}</td>
        <td>{$row['order_id']}</td>
        <td>{$row['article_price']}</td>
        <td>{$row['article_title']}</td>
        <td>{$row['article_quantity']}</td>
        <td><a class="btn btn-danger" href="delete_me_id={$_SESSION['user_id']}"><span class="glyphicon glyphicon-trash"></span></a></td>
    </tr>
DELIMETER;
    
echo $salereport;
}
}


function user_personal() { //siehe categories admin
    
    $user_query = query("SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}");
    confirm($user_query);
    
    while($row = fetch_array($user_query)) {
        
    $user_id = $row['user_id'];
    $email = $row['email'];
    $surname = $row['surname'];
    $name = $row['name'];
    $adress = $row['adress'];
    $postal = $row['postal'];
    $city = $row['city'];
        
    $user = <<<DELIMETER
    <tr>
        <td>{$user_id}</td>
        <td>{$email}</td>
        <td>{$surname}</td>
        <td>{$name}</td>
        <td>{$adress}</td>
        <td>{$postal}</td>
        <td>{$city}</td>
        <td><a class="btn btn-danger" href="delete_me.php?id={$_SESSION['user_id']}">Konto löschen</a></td>
        <td><a class="btn btn-success" href="user_edit.php?id={$_SESSION['user_id']}">Konto bearbeiten</a></td>
    </tr>
DELIMETER;
        
    echo $user; //echo den obigen delimeter
    }
}
//der nutzer kann seine daten bearbeiten (bis auf email)
function edit_user() {
    
    if(isset($_POST['update_user'])){
        
        
        $user_id = $_SESSION['user_id'];
        $error = false;
        $password   = escape_string($_POST['password']);
        $password2  = escape_string($_POST['password2']);
        $surname    = escape_string($_POST['surname']);
        $name       = escape_string($_POST['name']);
        $adress     = escape_string($_POST['adress']);
        $postal     = escape_string($_POST['postal']);
        $city       = escape_string($_POST['city']);
        
        $result = query("SELECT * FROM users WHERE user_id='$user_id'") or die($mysqli->error);
        
        if(strlen($password) == 0) {
            echo 'bitte passwort<br>';
            $error = true;
        }if($password != $password2) {
            echo 'pw müssen stimmen<br>';
            $error = true;
        
    
}
        
        if(!$error) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
        

$query = "UPDATE users SET ";
$query .= "password         = '{$password_hash}', ";
$query .= "surname          = '{$surname}', ";
$query .= "name             = '{$name}', ";
$query .= "adress           = '{$adress}', ";
$query .= "postal           = '{$postal}', ";
$query .= "city             = '{$city}' ";
$query .= "WHERE user_id= '{$user_id}'";
        
$send_update_query = query($query);
    
        confirm($send_update_query);
        redirect("index.php");
        
        
        
    }
}
}
?>