<?php require_once("config.php"); ?>

<?php //funktion um die produkt_quantity zu überprüfen, bei ausreichender hinzufügen, sonst nachricht an user

if(isset($_GET['add'])) {
    
    $query = query("SELECT * FROM articles WHERE article_id=" . escape_string($_GET['add']). " ");
    confirm($query);
    
    while($row = fetch_array($query)) {
        
        if($row['article_quantity'] != $_SESSION['article_' . $_GET['add']]) { //wenn produkt quantity stimmt +1
            
            $_SESSION['article_' . $_GET['add']]+=1;
            redirect("../public/checkout.php");
            
        } else {
            
            set_message("Es sind nur noch " . $row['article_quantity'] . " " . "{$row['article_title']}" . " auf Lager");
            redirect("../public/checkout.php");
        }
    }
    
} 
//warenkorb remove
if(isset($_GET['remove'])) {
    
    $_SESSION['article_' . $_GET['remove']]--;
    
    if($_SESSION['article_' . $_GET['remove']] <1) {
        
        unset($_SESSION['item_total']); //bei 0 auch werte aus dem gesamtfeld entfernen
        unset($_SESSION['item_quantity']);
        redirect("../public/checkout.php");
    } else {
        
        redirect("../public/checkout.php");
    }
}

if(isset($_GET['delete'])){
    
    $_SESSION['article_' . $_GET['delete']] = '0';
    unset($_SESSION['item_total']); //bei delete auch werte aus dem gesamtfeld entfernen
    unset($_SESSION['item_quantity']);
    redirect("../public/checkout.php");
    
}


function cart() {
    //variablen für warenkorb gesamt
    $total = 0;
    $item_quantity = 0;
    //variablen für paypal
    $item_name = 1;
    $item_number = 1;
    $amount = 1;
    $quantity = 1;
    foreach ($_SESSION as $name => $value) {
        
    if($value > 0 ) { //value ist anzahl
            
            
    if(substr($name, 0, 8) == "article_"){  //nimmt stellen aus dem string
        
    $length = strlen($name) - 8;
    $id = substr($name, 8 , $length); //session id erhalten
        
    $query = query("SELECT * FROM articles WHERE article_id = " . escape_string($id). " ");
    confirm($query);
    
    while($row = fetch_array($query)) {
        
    $subtotal = $row['article_price']*$value; //quantity * produkt preis
    $item_quantity +=$value;
        
    $article_image = display_image($row['article_image']);
        
    $article = <<<DELIMETER
    <tr>
        <td>{$row['article_title']}<br>
        
        <img width='80' src='../resources/{$article_image}'>
        
        </td>
        <td>{$row['article_price']} &euro;</td>
        <td>{$value}</td>
        <td>{$subtotal} &euro;</td>
        <td><a class='btn btn-warning' href="../resources/cart.php?remove={$row['article_id']}"><span class='glyphicon glyphicon-minus'></span></a>
            <a class='btn btn-success' href="../resources/cart.php?add={$row['article_id']}"><span class='glyphicon glyphicon-plus'></span></a>
            <a class='btn btn-danger' href="../resources/cart.php?delete={$row['article_id']}"><span class='glyphicon glyphicon-trash'></span></a></td>     
    </tr>
    <input type="hidden" name="item_name_$item_name" value="{$row['article_title']}">
    <input type="hidden" name="item_number_$item_number" value="{$row['article_id']}">
    <input type="hidden" name="amount_$amount" value="{$row['article_price']}">
    <input type="hidden" name="quantity_$quantity" value="{$value}">
DELIMETER;
        
echo $article;
    //paypal incrementing    
$item_name++;
$item_number++;
$amount++;
$quantity++;
        
}
        //sessions um gesamtpreis und anzahl weiterzugeben
        $_SESSION['item_total'] = $total += $subtotal;
        $_SESSION['item_quantity'] = $item_quantity;
        
            }            
               
        }
        

        
    }
    

}
//funktion für pay pal button damit angezeigt wenn items im warenkorb
function paypal_btn() {
    
    if(isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1) {
        
    
    $paypal_button = <<<DELIMETER
        <input type="image" name="upload" border="0"
           src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
           alt="Buy Now">
DELIMETER;
    
    return $paypal_button;
        
    }
}











//umgewandelte warenkorb funktion um im adminbereich statistiken anzuzeigen


function transaction() {
    
    
    if(isset($_GET['tx'])) { 
   
        //aus thank you .php kopiert um die order id in die sales tabelle zu übermitteln
    $amount = $_GET['amt'];
    $currency = $_GET['cc'];
    $transaction = $_GET['tx'];
    $status = $_GET['st'];

    $total = 0;
    $item_quantity = 0;
    foreach ($_SESSION as $name => $value) {
        
    if($value > 0 ) { //value ist anzahl
            
            
    if(substr($name, 0, 8) == "article_"){  //nimmt stellen aus dem string
        
    $length = strlen($name) - 8;
    $id = substr($name, 8 , $length); //session id erhalten
    //übermitteln der bestellung an datenbank    
    $send_order = query("INSERT INTO orders (user_id, order_amount, order_transaction, order_currency, order_status) VALUES('{$_SESSION['user_id']}','$amount','$transaction','$currency','$status')");
      //die letzte inserted id übermitteln  
    $last_id = last_id(); //gibt uns die letzte id (siehe functions.php)//
    confirm($send_order);
        
    $query = query("SELECT * FROM articles WHERE article_id = " . escape_string($id). " ");
    confirm($query); //die produkte mit der entsprechenden id raussuchen und escapen 
    
    while($row = fetch_array($query)) {
        
    $article_price = $row['article_price'];
    $article_title = $row['article_title']; 
    $subtotal = $row['article_price']*$value; //quantity * produkt preis
    $item_quantity +=$value;
    
        
        //values für insert ein die tabelle salesreports, damit der admin angucken kann, was und wie häufig verkauft wurde
    
        
    $insert_sales = query("INSERT INTO salereports (article_id, order_id, article_price, article_title, article_quantity) VALUES('{$id}', '{$last_id}', '{$article_price}', '{$article_title}', '{$value}')");
    
    confirm($insert_sales); //confirm wie immer um funktion nachzuweisen.
        
        
}

        $total += $subtotal; //wie oben bei cart.php
        $item_quantity;
        
            }            
               
        }
        

        
    }
        
session_destroy();
    } else { //falls es nicht geklappt hat,redirect auf index.php
    redirect("index.php");
}
    

}

?>